<?php
class MY_Form_validation extends CI_Form_validation{
    public function confirm_password($value){
        $this->set_message("confirm_password","%s entered does not match with your password");

        $this->CI->load->model("staff_model");
        $user_id = $this->CI->staff_model->sessionUserId();
        $result = $this->CI->db->get_where("tbl_staff",array("id" => $user_id))->row_array();
        if (count($result) > 0){
            if (password_verify($value,$result["password"])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function active_member($val){
        $this->set_message("active_member","This member is not activated yet or is not registered");
        $result = $this->CI->db->get_where("tbl_users",array("id_number" => $val, "status" => "active"))->num_rows();
        if ($result > 0){
            return true;
        }else{
            return false;
        }
    }
}