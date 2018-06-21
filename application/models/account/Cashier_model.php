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
}