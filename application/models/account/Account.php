<?php 
 
class Account extends CI_Model{	
    function addUser($data = array()) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET " . DB_PREFIX_C . "username = ".$this->db->escape(strtolower($data['username'])).", " . DB_PREFIX_C . "salt = " . $this->db->escape($salt = token(9)) . ", " . DB_PREFIX_C . "password = " . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . ", " . DB_PREFIX_REF . "group_id = 1, " . DB_PREFIX_C . "fullname = ".$this->db->escape($data['fullname']).", " . DB_PREFIX_C . "email = ".$this->db->escape($data['email']).", " . DB_PREFIX_C . "phone_number = ".$this->db->escape($data['telephone']).", " . DB_PREFIX_C . "status = 1 ");
        return true;
    }
    
    public function getTotalAccountByUsername($username) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE LOWER(" . DB_PREFIX_C . "username) = " . $this->db->escape(strtolower($username)) . "");
        
		return $query->row('total');
	}
}