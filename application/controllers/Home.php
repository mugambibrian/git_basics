<?php 
class Home extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->model("staff_model");
        $this->staff_model->redirectLoggedUser();
    }
    public function index($message = null){
        $data["message"] = $message;
        $data["main_content"] = "user/login";
        $this->load->view("partials/user/template",$data);
    }
    public function login(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("username","Username","trim|required|alpha_numeric|min_length[4]");
        $this->form_validation->set_rules("password","Password","trim|required");
        if ($this->form_validation->run() == false){
            $this->index();
        }else{
            //save to database
            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $result = $this->staff_model->login($username,$password);
            if ($result){
                redirect("/");
            }else{
                $message = '<p class="alert alert-danger">Wrong username or password</p>';
                $this->index($message);
            }
        }
    }
}