<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Manager_model extends CI_Model{
    public function getNewMembers(){
        $this->db->where(array(
            "status" => "pending"
        ));
        return $this->db->get("tbl_users")->result_array();
    }
    public function disapproveMember($id){
        $sql = "DELETE FROM `tbl_users` WHERE `id`=$id AND `status`='pending'";
        return $this->db->query($sql);
    }
    public function approveMember($id){
        $this->db->where(array(
            "id" => $id,
            "status" => "pending"
        ));
        $data = array("status" => "active");
        $this->db->set($data);
        return $this->db->update("tbl_users");
    }
    public function getAllLoans(){
        $sql = "SELECT `tbl_loan`.`id`,`tbl_users`.`first_name`,`tbl_users`.`last_name`,
        `tbl_users`.`id_number`,`tbl_loan`.`amount_borrowed`,`tbl_loan`.`status`,`tbl_loan`.`interest` 
        FROM `tbl_users` JOIN `tbl_loan` ON `tbl_users`.`id` = `tbl_loan`.`user`";
        return $this->db->query($sql)->result_array();
    }
    public function loanDetails($id){
        $this->load->model("loan_model");
        $sql = "SELECT `tbl_loan`.`id`,`tbl_users`.`first_name`,`tbl_users`.`occupation`,`tbl_users`.`last_name`,
        `tbl_users`.`id_number`,`tbl_loan`.`amount_borrowed`,`tbl_loan`.`amount_to_pay`,`tbl_loan`.`status`,`tbl_loan`.`loan_type` as `type`,`tbl_loan`.`interest` 
        FROM `tbl_users` JOIN `tbl_loan` ON `tbl_users`.`id` = `tbl_loan`.`user` WHERE `tbl_loan`.`id`=".$id;
        $result =  $this->db->query($sql)->row_array();
        if (count($result > 0)){
            $type = $result['type'];
            $result['type'] = $this->loan_model->getLoanById($type)['name'];
            return $result;
        }else{
            return array();
        }
    }
    public function approveLoan($id=null){
        if ($id == null){
            return null;
        }else{
            $this->load->model("loan_model");
            $id = $this->db->escape_str($id);
            $data = array(
                "status" => "approved"
            );
            return $this->loan_model->updateBorrowedLoan($id,$data);
        }
    }
    public function disapproveLoan($id=null){
        if ($id == null){
            return null;
        }else{
            $this->load->model("loan_model");
            $id = $this->db->escape_str($id);
            $data = array(
                "status" => "not approved"
            );
            return $this->loan_model->updateBorrowedLoan($id,$data);
        }
    }
}