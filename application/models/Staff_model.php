<?php
class Staff_model extends CI_Model{
    public function login($username,$password){
        $user = $this->db->escape_str($username);
        $pass = $this->db->escape_str($password);

        $this->db->select("id,username,password");
        $this->db->where("username",$username);
        $result = $this->db->get("tbl_staff")->row_array();
        if (count($result) > 0){
            //verify user password
            $password_hashed = $result["password"];
            if(password_verify($pass,$password_hashed)){
                $this->createUserSession($result["id"]);
                $this->updateLastLogin($result["id"]);
                $this->updateCurrentLogin($result["id"]);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    private function updateCurrentLogin($id){
        $this->db->where("id",$id);
        $save = array(
            "current_login" => mdate("%Y-%m-%d %H:%i:%s",now())
        );
        $this->db->set($save);
        return $this->db->update("tbl_staff",$save);
    }
    private function updateLastLogin($id){
        $save = $this->getCurrentLogin($id);
        $sql = "UPDATE tbl_staff SET last_login = '$save' WHERE id = $id";
        return $this->db->query($sql);
    }
    private function getCurrentLogin($id){
        $this->db->where("id",$id);
        $this->db->select("current_login");
        return $this->db->get("tbl_staff")->row_array()["current_login"];
    }
    private function createUserSession($id){
        if ($this->session->has_userdata("user_id")){
            $this->session->unset_userdata("user_id");
            $this->session->set_userdata("user_id",$id);
        }else{
            $this->session->set_userdata("user_id",$id);
        }
    }
    private function getUserData($select,$where){
        $this->db->select($select);
        return $this->db->get_where("tbl_staff",$where)->row_array();
    }
    public function sessionUserId(){
        if ($this->session->has_userdata("user_id")){
            return $this->session->userdata("user_id");
        }else{
            return null;
        }
    }
    public function changePassword($password){
        $id = $this->sessionUserId();
        $pass = $this->db->escape_str($password);
        if ($id != null){
            $this->db->where("id",$id);
            $update_data = array(
                "password" => password_hash($pass,PASSWORD_BCRYPT,array("cost" => 10))
            );
            $this->db->set($update_data);
            if ($this->db->update("tbl_staff",$update_data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function getStaffById($id){
        return $this->getUserData("*",array("id"=>$this->escapeData($id)));
    }
    public function updateStaff($data,$where){
        $this->db->where($where);
        $saveData["first_name"] = $this->escapeData($data["fname"]);
        $saveData["last_name"] = $this->escapeData($data["lname"]);
        $saveData["userlevel"] = $this->escapeData($data["userlevel"]);
        if (isset($data["password"]) && $data["password"] != ''){
            $saveData["password"] = password_hash($this->escapeData($data["password"]),PASSWORD_BCRYPT,array("cost"=>10));
        }
        $this->db->set($saveData);
        return $this->db->update("tbl_staff",$saveData);   
    }
    private function countUsers($where){
        $this->db->where($where);
        return $this->db->get("tbl_staff")->num_rows();
    }
    private function escapeData($data){
        return $this->db->escape_str(htmlentities($data));
    }
    public function newStaff($data){
        $saveData = array(
            "username" => $this->escapeData($data["username"]),
            "first_name" => $this->escapeData($data["first_name"]),
            "last_name" => $this->escapeData($data["last_name"]),
            "userlevel" => $this->escapeData($data["userlevel"]),
            "password" => password_hash($this->escapeData($data["password"]),PASSWORD_BCRYPT,array("cost"=>10))
        );
        return $this->db->insert("tbl_staff",$saveData);
    }
    public function staffCountSummary(){
        $data["activeAdmins"] = $this->countUsers(array("status"=>"active","userlevel"=>"Admin"));
        $data["activeManagers"] = $this->countUsers(array("status"=>"active","userlevel"=>"Manager"));
        $data["activeAccounts"] = $this->countUsers(array("status"=>"active","userlevel"=>"Accounts"));

        $data["retired"] = $this->countUsers(array("status"=>"retired"));
        $data["suspended"] = $this->countUsers(array("status"=>"suspended"));
        $data["dismissed"] = $this->countUsers(array("status"=>"dismissed"));
        $data["total"] = $data["activeAdmins"] + $data["dismissed"] + $data["activeManagers"] + $data["suspended"] + $data["activeAccounts"] + $data["retired"];

        return $data;
    }
    public function getLoggedUserDetails(){
        $select = "id,first_name,last_name,username,userlevel,status,last_login";
        if ($this->sessionUserId() != null){
            return $this->getUserData($select,array(
                "id" => $this->sessionUserId()
            ));
        }else{
            return null;
        }
    }
    public function redirectLoggedUser(){
        if ($this->session->has_userdata("user_id")){
            $user_id = $this->session->userdata("user_id");
            $user = $this->getUserData("userlevel",array(
                "status" => "active",
                "id" => $user_id
            ));
            if (count($user) > 0){
                $userlevel = $user["userlevel"];
                switch($userlevel){
                    case "Manager":
                        redirect("manager");
                        break;
                    case "Admin":
                        redirect("admin");
                        break;
                    case "Accounts":
                        redirect("accounts");
                        break;
                    default:
                        break;
                }
            }
        }
    }
    public function getAll()
    {
        $this->db->where(array(
            "id !=" => $this->sessionUserId()
        ));
        $this->db->select("id,username,first_name,last_name,userlevel,status");
        return $this->db->get("tbl_staff")->result_array();
    }
}