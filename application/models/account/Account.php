<?php 
 
class Account extends CI_Model{	
    function addUser($data = array()) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET " . DB_PREFIX_C . "username = ".$this->db->escape(strtolower($data['username'])).", " . DB_PREFIX_C . "salt = " . $this->db->escape($salt = token(9)) . ", " . DB_PREFIX_C . "password = " . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . ", " . DB_PREFIX_REF . "group_id = 1, " . DB_PREFIX_C . "fullname = ".$this->db->escape($data['fullname']).", " . DB_PREFIX_C . "email = ".$this->db->escape($data['email']).", " . DB_PREFIX_C . "phone_number = ".$this->db->escape($data['telephone'])."," . DB_PREFIX_C . "address = ".$this->db->escape($data['address']).", " . DB_PREFIX_C . "status = 1 ");
        return true;
    }
    
    public function getTotalAccountByUsername($username) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE LOWER(" . DB_PREFIX_C . "username) = " . $this->db->escape(strtolower($username)) . "");
        
		return $query->row('total');
	}
	
	public function getInfoUser($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = ".$user_id." ");
        $rows = $query->row();
        return $rows;
		
	}
	
	public function editProfile($data = array()) {
	    $this->load->library('user');
	    $check_pw = $this->db->query("SELECT COUNT(*) as total FROM `" . DB_PREFIX . "user` WHERE " . DB_PREFIX_C . "password = ".$this->db->escape($data['password'])."");
	   // print_r($data);exit;
	    if($check_pw->row('total') == 0 ){
	        $query = $this->db->query("UPDATE " . DB_PREFIX . "user SET " . DB_PREFIX_C . "fullname = ".$this->db->escape($data['fullname']).", " . DB_PREFIX_C . "salt = " . $this->db->escape($salt = token(9)) . ", " . DB_PREFIX_C . "password = " . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . ", " . DB_PREFIX_C . "address = ".$this->db->escape($data['address']) ." WHERE user_id = ".$this->user->getId()." ");
	    } else {
	        $query = $this->db->query("UPDATE " . DB_PREFIX . "user SET " . DB_PREFIX_C . "fullname = ".$this->db->escape($data['fullname']).", " . DB_PREFIX_C . "address = ".$this->db->escape($data['address']) ." WHERE user_id = ".$this->user->getId()." ");
	    }
		
        
        return true;
		
	}
	
	public function getTotalMerchant() {
	    $this->load->library('user');
	    
	    $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE " . DB_PREFIX_C . "parent_id = ".$this->user->getId()." AND " . DB_PREFIX_REF . "group_id = 2 AND " . DB_PREFIX_C . "status = 1 ");
        
		return $query->row('total');
    }
    
    public function getTotalCashier($data = array()) {
        $this->load->library('user');
        if($this->user->getGroupId() == 1) {
            $sql_get_parent = "SELECT user_id FROM `" . DB_PREFIX . "user` WHERE " . DB_PREFIX_C . "parent_id = ". $this->user->getId()." AND " . DB_PREFIX_REF . "group_id = 2 ";
            $query_get_parent= $this->db->query($sql_get_parent);
            $get_parent_rows = $query_get_parent->result();
            
            $sql = "SELECT COUNT(*) as total FROM `" . DB_PREFIX . "cashier` c WHERE";
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
            $total = $query->row('total');
            
        } else {
            $sql = "SELECT c.*,(SELECT COUNT(*) as total FROM `" . DB_PREFIX . "cashier` c WHERE c." . DB_PREFIX_REF . "parent_id = ".$this->user->getId()." ";
            $query = $this->db->query($sql);
            $total = $query->row('total');
        }

        return $total;
    }
}