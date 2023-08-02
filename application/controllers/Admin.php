<?php
class Admin extends CI_Controller{

    var $user = null;
    public function __construct(){
        parent::__construct();
        $this->load->model("staff_model");
        $this->user = $this->staff_model->getLoggedUserDetails();
        if ($this->user == false){
            redirect("/");
        }else{
            if ($this->user["userlevel"] != "Admin"){
                redirect("/");
            }
        }
    }
    public function index(){
        $data["user"] = $this->user;
        $data["staffs"] = $this->staff_model->staffCountSummary();
        $data["main_content"] = "admin/home";
        $this->load->view("partials/admin/template",$data);
    }
    public function new_account(){
        $data["main_content"] = "admin/newAccount_view";
        $this->load->view("partials/admin/template",$data);
    }
    public function loanEdit($id = null){
        if ($id != null){
            $this->load->model("loan_model");
            $result = $this->loan_model->getLoanById($id);
            if (count($result) > 0){
                $data["loan"] = $result;
                $data["main_content"] = "admin/loanEdit_view";
                $this->load->view("partials/admin/template",$data);
            }else{
                $this->loans();
            }
            
        }else{
            $this->loans();
        }
    }
    private function escapeData($data){
        return $this->db->escape_str(htmlentities($data));
    }
    public function editLoan()
    {
        $this->load->model("loan_model");
        $this->load->library("form_validation");
        $this->form_validation->set_rules("loanName","Loan Type","trim|required|alpha_numeric_spaces|is_unique[tbl_loantype.name]");
        $this->form_validation->set_rules("interest","Loan Interest","trim|required|numeric");
        $id = $this->input->post("loanId");
        if ($this->form_validation->run() == false){
            $this->loanEdit($id);
        }else{
            //update changes to the database
            $saveData = array(
                "name" => $this->escapeData($this->input->post("loanName")),
                "interest" => $this->escapeData($this->input->post("interest"))
            );
            if ($this->loan_model->updateLoanById($id,$saveData)){
                $this->loans("Successfully updated","success");
            }else{
                $this->loans("Was unable to update please retry","warning");
            }
        }

    }
    public function manageAccount(){
        $data["staffs"] = $this->staff_model->getAll();
        $data["main_content"] = "admin/manageAccount_view";
        $this->load->view("partials/admin/template",$data);
    }
    public function loans($message = null, $type = null){
        $this->load->model("loan_model");

        $data["message"] = $message;
        $data["type"] = $type? $type:"danger";
        $data["loans"] = $this->loan_model->getLoanTypes();
        $data["summary"] = $this->loan_model->get_loanSummary();
        $data["main_content"] = "admin/loans_view";
        $this->load->view("partials/admin/template",$data);
    }
    public function addLoan(){
        $data["main_content"] = "admin/addLoanType_view";
        $this->load->view("partials/admin/template",$data);
    }
    public function newLoan(){
        $this->load->model("loan_model");
        $this->load->library("form_validation");
        $this->form_validation->set_rules("loanName","Loan Type","trim|required|alpha_numeric_spaces|is_unique[tbl_loantype.name]");
        $this->form_validation->set_rules("interest","Loan Interest","trim|required|numeric|greater_than[-1]");
        if ($this->form_validation->run() == false){
            $this->addLoan();
        }else{
            $saveData = array(
                "name" => $this->escapeData($this->input->post("loanName")),
                "interest" => $this->escapeData($this->input->post("interest"))
            );
            if ($this->loan_model->newLoanType($saveData)){
                $this->loans("Successfully saved","success");
            }else{
                $this->loans("Failed to save records","danger");
            }
        }
    }
    public function changePassword($msg = null,$type=null){
        $data["message"] = $msg;
        $data["type"] = $type;
        $data["main_content"] = "admin/changeMyPassword_view";
        $this->load->view("partials/admin/template",$data);
    }
    public function changePass(){
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
                $this->changePassword("Password successfully changed","alert-success");
            }else{
                $this->changePassword("password failed to change", "alert-warning");
            }
        }
    }
    public function editUser(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("fname","First Name","trim|required|alpha_numeric_spaces|min_length[4]");
        $this->form_validation->set_rules("lname","Last Name","trim|required|alpha_numeric_spaces|min_length[4]");
        $this->form_validation->set_rules("userlevel","Userlevel","trim|required|alpha");
        $password = trim($this->input->post("password"));
        $id = $this->input->post("id");
        if ($password != '' || $password != null){
            $this->form_validation->set_rules("password","Password","trim|required|min_length[8]");
        }
        if ($this->form_validation->run() == false){
            $this->edit($id);
        }else{
            //update data to database
            $data["fname"] = $this->input->post("fname");
            $data["lname"] = $this->input->post("lname");
            $data["userlevel"] = $this->input->post("userlevel");
            if ($password != "" || $password != null){
                $data["password"] = $this->input->post("password");
            }
            $where = array(
                "id" => $this->db->escape_str($id)
            );
            $result = $this->staff_model->updateStaff($data,$where);
            if ($result){
                redirect("admin/manageAccount");
            }else{
                $this->edit($id);
            }
        }
    }
    public function edit($id = null){
        if ($id == null){
            $this->manageAccount();
        }else{
            $result = $this->staff_model->getStaffById($id);
            if (!count($result) > 0){
                $this->manageAccount();
            }else{
                $data["user_id"] = $result["id"];
                $data["fname"] = strtoupper($result["first_name"]);
                $data["lname"] = strtoupper($result["last_name"]);
                $data["userlevel"] = $result["userlevel"];
                $data["username"] = strtolower($result["username"]);
                $data["main_content"] = "admin/editStaff_view";
                $this->load->view("partials/admin/template",$data);
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect("/");
    }
    public function postNewStaff(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("username","Username","trim|required|alpha_numeric|min_length[4]|is_unique[tbl_staff.username]");
        $this->form_validation->set_rules("fname","First Name","trim|required|alpha_numeric_spaces");
        $this->form_validation->set_rules("lname","Last Name","trim|required|alpha_numeric_spaces");
        $this->form_validation->set_rules("userlevel","Userlevel","trim|required|alpha");
        $this->form_validation->set_rules("password","Password","trim|required|min_length[8]");
        if ($this->form_validation->run() == false){
            $this->new_account();
        }else{
            $data["username"] = $this->input->post("username");
            $data["first_name"] = $this->input->post("lname");
            $data["last_name"] = $this->input->post("fname");
            $data["userlevel"] = $this->input->post("userlevel");
            $data["password"] = $this->input->post("password");
            $result = $this->staff_model->newStaff($data);
            if ($result){
                redirect("admin");
            }else{
                $this->new_account();
            }
        }
    }
}