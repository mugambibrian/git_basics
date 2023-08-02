<?php
class  Accounts extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("staff_model");
        $this->user = $this->staff_model->getLoggedUserDetails();
        if ($this->user == false){
            redirect("/");
        }else{
            if ($this->user["userlevel"] != "Accounts"){
                redirect("/");
            }
        }
    }
    public function index(){
        $this->load->model('loan_model');
        $summary = $this->loan_model->getFullSummary();
        
        $data['summary'] = $summary;
        $data["user"] = $this->staff_model->getLoggedUserDetails();
        $data["main_content"] = "accounts/home_view";
        $this->load->view("partials/accounts/template",$data);
    }
    public function members($message = null,$type = null){
        $this->load->model("user_model");
        
        $data["users"] = $this->user_model->getAllMembers();
        $data["message"] = $message;
        $data["type"] = $type? $type:"warning";
        $data["main_content"] = "accounts/members_view";
        $this->load->view("partials/accounts/template",$data);
    }
    public function add_member($message = null, $type = null){
        $data["message"] = $message;
        $data["type"] = $type? $type:"warning";
        $data["main_content"] = "accounts/add_members_view";
        $this->load->view("partials/accounts/template",$data);
    }
    private function escapeData($data){
        return htmlentities($this->db->escape_str($data));
    }
    public function addMember(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("id","Identity Number","trim|required|is_unique[tbl_users.id_number]");
        $this->form_validation->set_rules("fname","First Name","trim|required");
        $this->form_validation->set_rules("lname","Last Name","trim|required");
        $this->form_validation->set_rules("gender","Gender","trim|required");
        $this->form_validation->set_rules("status","Marital Status","trim|required");
        $this->form_validation->set_rules("occupation","Occupation","trim|required");
        if ($this->form_validation->run() == false){
            $this->add_member();
        }else{
            $this->load->model("user_model");
            $user = array(
                "id_number" => $this->escapeData($this->input->post("id")),
                "first_name" => $this->escapeData($this->input->post("fname")),
                "last_name" => $this->escapeData($this->input->post("lname")),
                "gender" => $this->escapeData($this->input->post("gender")),
                "marital_status" => $this->escapeData($this->input->post("status")),
                "occupation" => $this->escapeData($this->input->post("occupation"))
            );
            $result = $this->user_model->addMember($user);
            if ($result){
                $this->members("Members successfully registered approval is pending","success");
            }else{
                $this->add_member("Failed to add new member","danger");
            }
        }
    }
    public function editUser($id = null){
        if ($id != null){
            $this->load->model("user_model");
            $user = $this->user_model->findOneById($id);
            if (count($user) > 0){
                //load edit form page
                $data["user"] = $user;
                $data["main_content"] = "accounts/edit_member_view";
                $this->load->view("partials/accounts/template",$data);
            }else{
                //no member was found
                $this->members("No member was found","info");
            }
        }else{
            $this->members();
        }
    }
    public function editMember(){
        $id = $this->input->post("mem_id");

        $this->load->library("form_validation");
        $this->form_validation->set_rules("id","Identity Number","trim|required|greater_than[-1]");
        $this->form_validation->set_rules("fname","First Name","trim|required|alpha_numeric_spaces");
        $this->form_validation->set_rules("lname","Last Name","trim|required|alpha_numeric_spaces");
        $this->form_validation->set_rules("gender","Gender","trim|required");
        $this->form_validation->set_rules("status","Marital Status","trim|required");
        $this->form_validation->set_rules("occupation","Occupation","trim|required");
        if ($this->form_validation->run() == false){
            $this->editUser($id);
        }else{
            //update to database
            $this->load->model("user_model");
            $user = array(
                "id_number" => $this->escapeData($this->input->post("id")),
                "first_name" => $this->escapeData($this->input->post("fname")),
                "last_name" => $this->escapeData($this->input->post("lname")),
                "gender" => $this->escapeData($this->input->post("gender")),
                "marital_status" => $this->escapeData($this->input->post("status")),
                "occupation" => $this->escapeData($this->input->post("occupation"))
            );
            $result = $this->user_model->updateMemberById($id,$user);
            if ($result){
                $this->members("Member details were successfully updated","success");
            }else{
                $this->members("Member details couldn't be updated, some changes may be pending please confirm with the manager","danger");
            }
        }
    }
    public function pay_loan($type = null,$message = null){
        $data["type"] = $type;
        $data["message"] = $message;
        $data["main_content"] = "accounts/payLoan_view";
        $this->load->view("partials/accounts/template",$data);
    }
    public function payLoanFinal(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("identity","Identity","trim|required|numeric");
        $this->form_validation->set_rules("identity_no","Id Number","trim|required|numeric");
        $this->form_validation->set_rules("amount","Amount","trim|required|numeric");
        if ($this->form_validation->run()){
            $id = $this->escapeData($this->input->post("identity"));
            $identity_no = $this->escapeData($this->input->post("identity_no"));
            $amount = $this->escapeData($this->input->post("amount"));
            $this->load->model("loan_model");
            $result = $this->loan_model->payLoan($id,$identity_no,$amount);
            if ($result){
                $this->pay_loan("success","Loan payment was successfully submited");
            }else{
                $this->pay_loan("warning","Payment could not be received check wether the amount your paying is not more than the loan");
            }
        }else{
            $this->pay_loan("danger","Please enter the correct details to continue");
        }
    }
    public function loan_pay(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("id_no","ID Number","trim|required|numeric");
        $this->form_validation->set_rules("reference","Reference Number","trim|required|numeric");
        if ($this->form_validation->run()){
            //continue
            $this->load->model("loan_model");
            $id_no = trim($this->input->post("id_no"));
            $ref = trim($this->input->post("reference"));
            $result = $this->loan_model->payLoan_Step_one($id_no,$ref);
            if (count($result) > 0){
                $data["loan"] = $result["loan"];
                $data["user"] = $result["user"];
                $data["main_content"] = "accounts/pay_loan_final_view";
                $this->load->view("partials/accounts/template",$data);
            }else{
                $this->pay_loan("danger",
                "The reference no and ID No do not match in any records of loan that was appoved and withdrawn");
            }
        }else{
            $this->pay_loan();
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect("/");
    }
    public function apply_loan($type = null, $message = null){
        $this->load->model("loan_model");
        $loan_details = $this->loan_model->getLoanTypes();
        $loans = array();
        foreach($loan_details as $_loan){
            $loans[$_loan["id"]] = strtoupper($_loan["name"]);
        }
            
        $data["type"] = $type;
        $data["message"] = $message;
        $data["loan_type"] = $loans;
        $data["main_content"] = "accounts/applyLoan_view";
        $this->load->view("partials/accounts/template",$data);
    }
    public function loanApplication(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("id_no","ID Number","trim|required|numeric|active_member");
        $this->form_validation->set_rules("amount","Aount","trim|required|numeric|greater_than[0]");
        $this->form_validation->set_rules("type","Loan Type","trim|required|numeric");
        if ($this->form_validation->run() == false){
            $this->apply_loan();
        }else{
            //save it to database
            $this->load->model("loan_model");
            $id = $this->input->post("id_no");
            $amount = $this->input->post("amount");
            $type = $this->input->post("type");

            $result = $this->loan_model->applyLoan($id,$amount,$type);
            if ($result){
                $this->apply_loan("success","Loan was application waiting for approval");
            }else{
                $this->apply_loan("danger"."Failed to apply loan user may not be approved or not registered");
            }
        }
    }
    public function payments(){
        $this->load->model("loan_model");
        $data['loans'] = $this->loan_model->getApprovedLoans();

        $data["main_content"] = "accounts/payment_view";
        $this->load->view("partials/accounts/template",$data);
    }
    public function loan_details($id = null){
        if ($id != null){
            $this->load->model('loan_model');
            $result = $this->loan_model->getFullLoanDetails($id);

            if (count($result) > 0){
                $data['details'] = $result['details'];
                $data['payments'] = $result['payment'];
                $data["main_content"] = "accounts/loanDetails_view";
                $this->load->view("partials/accounts/template",$data);
            }else{
                $this->payments();
            }
            
        }else{
            $this->payments();
        }
    }
    public function loan(){
        $this->load->model("loan_model");
        $data["loans"] = $this->loan_model->getAllLoans();
        $data["main_content"] = "accounts/loans_view";
        $this->load->view("partials/accounts/template",$data);
    }
    public function changePassword($message = null,$type = null){
        $data["message"] = $message;
        $data["type"] = $type? $type:"warning";
        $data["main_content"] = "accounts/changeMyPassword_view";
        $this->load->view("partials/accounts/template",$data);
    }
    public function passChange(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("current","Current Password","trim|required|confirm_password");
        $this->form_validation->set_rules("new","New Password","trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm","Confirm Password","trim|required|matches[new]");
        if ($this->form_validation->run() == false){
            $this->changePassword();
        }else{
            $password = $this->input->post("new");
            $result = $this->staff_model->changePassword($password);
            if ($result){
                $this->changePassword("Password successfully changed","success");
            }else{
                $this->changePassword("password failed to change", "warning");
            }
        }
    }
}