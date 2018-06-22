<?php 
 class Cashier_Model extends CI_Model{
    public function getCashiers($data = array()) {
        $this->load->library('user');
        if($this->user->getGroupId() == 1) {
            $sql_get_parent = "SELECT user_id FROM `" . DB_PREFIX . "user` WHERE " . DB_PREFIX_C . "parent_id = ". $this->user->getId()." AND " . DB_PREFIX_REF . "group_id = 2 ";
            $query_get_parent= $this->db->query($sql_get_parent);
            $get_parent_rows = $query_get_parent->result();
            
            $sql = "SELECT c.*,(SELECT u." . DB_PREFIX_C . "fullname FROM `" . DB_PREFIX . "user` u WHERE user_id = " . DB_PREFIX_REF . "parent_id) as parent_name,(SELECT u." . DB_PREFIX_C . "fullname FROM `" . DB_PREFIX . "user` u WHERE user_id = " . DB_PREFIX_REF . "added_by) as added_by_name FROM `" . DB_PREFIX . "cashier` c WHERE";
            $check = 0;
            foreach($get_parent_rows as $get_parent_row) {
                if($check == 0){
                    $sql .= " c." . DB_PREFIX_REF . "parent_id = ".$get_parent_row->user_id."";
                } else {
                    $sql .= " OR c." . DB_PREFIX_REF . "parent_id = ".$get_parent_row->user_id."";
                }
                
                $check++;
            }
            
            $query = $this->db->query($sql);
            $rows = $query->result();
            
        } else {
            $sql = "SELECT c.*,(SELECT u." . DB_PREFIX_C . "fullname FROM `" . DB_PREFIX . "user` u WHERE user_id = " . DB_PREFIX_REF . "parent_id) as parent_name,(SELECT u." . DB_PREFIX_C . "fullname FROM `" . DB_PREFIX . "user` u WHERE user_id = " . DB_PREFIX_REF . "added_by) as added_by_name FROM `" . DB_PREFIX . "cashier` c WHERE c." . DB_PREFIX_REF . "parent_id = ".$this->user->getId()." ";
            $query = $this->db->query($sql);
            $rows = $query->result();
        }

        return $rows;
    }

    public function getCashierId($cashier_id) {
        $sql = "SELECT c.*,(SELECT u." . DB_PREFIX_C . "fullname FROM `" . DB_PREFIX . "user` u WHERE user_id = " . DB_PREFIX_REF . "parent_id) as parent_name,(SELECT u." . DB_PREFIX_C . "fullname FROM `" . DB_PREFIX . "user` u WHERE user_id = " . DB_PREFIX_REF . "added_by) as added_by_name FROM `" . DB_PREFIX . "cashier` c WHERE c.cashier_id = ".$cashier_id." ";
        
        $query = $this->db->query($sql);
        $row = $query->row();
            
        
        return $row;
    }

    public function addCashier($data = array()) {
        $this->load->library('user');
        $sql = "INSERT INTO `" . DB_PREFIX . "cashier` SET " . DB_PREFIX_C . "code_cashier = ".$this->db->escape($data['code_cashier'])."," . DB_PREFIX_C . "status = ".$data['status']."," . DB_PREFIX_C . "name = ".$this->db->escape($data['name']). ", " . DB_PREFIX_C . "address = ".$this->db->escape($data['address']).", " . DB_PREFIX_REF . "parent_id = ".$data['merchant_id']."," . DB_PREFIX_REF . "added_by = ".$this->user->getId()."    ";
        $this->db->query($sql);
        return true;
    }

    public function checkUser($user_id) {
        $sql = "SELECT COUNT(*) as total FROM `" . DB_PREFIX . "user` WHERE user_id = ".$user_id." ";
        $query = $this->db->query($sql);
        $total = $query->row('total');
        return $total; 
    }
}