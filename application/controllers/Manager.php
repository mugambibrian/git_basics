<?php
class Manager extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('staff_model','admin_model'));
        $this->user = $this->staff_model->getLoggedUserDetails();
        if ($this->user == false){
            redirect("/");
        }else{
            if ($this->user["userlevel"] != "Manager"){
                redirect("/");
            }
        }
        $this->load->model("manager_model");
    }
    public function getSummary(){
        $this->output->set_content_type('application/json');
        $sum = $this->admin_model->getFullSummary();
        $this->output->set_output(json_encode($sum));
    }
    public function index(){
        $data["user"] = $this->staff_model->getLoggedUserDetails();
        $data['sum'] = $this->admin_model->getFullSummary();
        $data["main_content"] = "manager/home_view";
        $this->load->view("partials/manager/template",$data);
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect("/");
    }
    public function changePassword($message = null,$type = null)
    {
        $data["message"] = $message;
        $data["type"] = $type? $type : "alert-warning";
        $data["main_content"] = "manager/changeMyPassword_view";
        $this->load->view("partials/manager/template",$data);
    }
    public function passChange(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("current","Current Password","trim|required|confirm_password");
        $this->form_validation->set_rules("new","New Password","trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm","Confirm Password","trim|required|matches[new]");
        if ($this->form_validation->run() == false){
            $this->changePassword();
        }else{
            $result = $this->staff_model->changePassword($this->input->post("new"));
            if ($result){
                $this->changePassword("Password was successfully changed","alert-success");
            }else{
                $this->changePassword("Password failed to change","alert-danger");
            }
        }
    }
    public function members($message=null,$type=null){
        $this->load->model('user_model');
        $data['mems'] = $this->user_model->getAllMembers();
        $data["members"] = $this->manager_model->getNewMembers();

        $data["type"] = $type;
        $data["message"] = $message;
        $data["main_content"] = "manager/members_view";
        $this->load->view("partials/manager/template",$data);
    }
    public function disapproveMember($userid=null){
        if ($userid == null){
            $this->members();
        }else{
            $result = $this->manager_model->disapproveMember($userid);
            if ($result){
                $this->members();
            }else{
                $this->members("I error occured","danger");
            }
        }
    }
    public function approveMember($userid=null)
    {
        if ($userid == null){
            $this->members();
        }else{
            $result = $this->manager_model->approveMember($userid);
            if ($result){
                $this->members();
            }else{
                $this->members("I error occured","danger");
            }
        }
    }
    public function loans(){
        $data["loans"] = $this->manager_model->getAllLoans();
        $data["main_content"] = "manager/loans_view";
        $this->load->view("partials/manager/template",$data);
    }
    public function viewLoan($id = null){
        if ($id == null){
            $this->loans();
        }else{
            $data["loan"] = $this->manager_model->loanDetails($id);
            if (count($data['loan']) > 0){
                $data["main_content"] = "manager/singleLoans_view";
                $this->load->view("partials/manager/template",$data);
            }else{
                $this->loans();
            }  
        }
        
    }
    public function approveLoan($id){
        $this->load->model("manager_model");
        $result = $this->manager_model->approveLoan($id);
        if ($result == null){
            
        }elseif($result == false){
            $this->viewLoan($id);
        }else{
            $this->viewLoan($id);
        }
    }
    public function disapproveLoan($id){
        $this->load->model("manager_model");
        $result = $this->manager_model->disapproveLoan($id);
        if ($result == null){
            
        }elseif($result == false){
            $this->viewLoan($id);
        }else{
            $this->viewLoan($id);
        }
    }
    public function payments(){
        $this->load->model("loan_model");
        $data['loans'] = $this->loan_model->getApprovedLoans();
        $data["main_content"] = "manager/payments_view";
        $this->load->view("partials/manager/template",$data);
    }
    public function loan_details($id = null){
        if ($id != null){
            $this->load->model('loan_model');
            $result = $this->loan_model->getFullLoanDetails($id);

            if (count($result) > 0){
                $data['details'] = $result['details'];
                $data['payments'] = $result['payment'];
                $data["main_content"] = "manager/loanDetails_view";
                $this->load->view("partials/manager/template",$data);
            }else{
                $this->payments();
            }
            
        }else{
            $this->payments();
        }
    }
}