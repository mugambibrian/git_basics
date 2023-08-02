<?php
defined('BASEPATH') or exit("No direct script access");
class User_model extends CI_Model{
    public function addMember($data){
        return $this->db->insert("tbl_users",$data);
    }
    public function addEditMember($data){
        return $this->db->insert("tbl_usersedit",$data);
    }
    public function getAllMembers(){
        return $this->db->get("tbl_users")->result_array();
    }
    public function findOneById($id){
        $_id = $this->db->escape_str($id);
        return $this->db->get_where("tbl_users",array(
            "id" => $_id
        ))->row_array();
    }
    public function newMembers(){
        return $this->db->get_where('tbl_users',array('status'=>'pending'))->num_rows();
    }
    public function allMembers(){
        return $this->db->get_where('tbl_users',array('status'=>'active'))->num_rows();
    }
    public function updateMemberById($id,$data){
        $_id = $this->db->escape_str($id);
        $sql = "SELECT `status` FROM `tbl_users` WHERE `id` = $_id";
        $result = $this->db->query($sql)->row_array();
        if (count($result) > 0){
            $status = $result["status"];
            if (strtolower($status) == "pending"){
                $this->db->set($data);
                $this->db->where("id",$_id);
                return $this->db->update("tbl_users");
            }else{
                $sql2 = "SELECT * FROM tbl_usersedit WHERE `user_id` = $_id";
                $counter = $this->db->query($sql2)->num_rows();
                if ($counter > 0){
                    return false;
                }else{
                    $user = array_merge($data,array("user_id" => $id));
                    return $this->addEditMember($user);
                }
            }
        }else{
            return false;
        }
    }
    public function findOneByNationalId($id){
        $_id = $this->db->escape_str($id);
        return $this->db->get_where("tbl_users",array(
            "id_number" => $_id
        ))->row_array();
    }
    /*public function getAllMembers(){
        return $this->db->get('tbl_users')->result_array();
    }*/
}