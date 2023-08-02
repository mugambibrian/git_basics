<?php
class Admin_model extends CI_Model{
    public function getFullSummary(){
        $this->load->model(array('loan_model','user_model'));

        $sum['new_members'] = $this->user_model->newMembers();
        $sum['all_members'] = $this->user_model->allMembers();
        $sum['pending'] = $this->loan_model->getCountPendingLoan();
        $sum['approved'] = $this->loan_model->getCountApprovedLoan();
        $sum['not_approved'] = $this->loan_model->getCountNotApprovedLoan();
        return $sum;
    }
}