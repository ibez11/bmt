<?php
class User {
	private $user_id;
	private $username;
        private $fullname;
        private $email;
        private $group_name;
	private $CI;
	private $permission = array();
	
	public function __construct() {
		$this->CI =& get_instance();
		//if(isset($this->CI->session)){  //Check if session lib is loaded or not
		//$this->CI->load->database();
		$this->CI->load->library('session');  //If not loaded, then load it here
		
        //}
		if ($this->CI->session->userdata('user_id')) {
			$user_query = $this->CI->db->query("SELECT * FROM " . DB_PREFIX . "user  WHERE user_id = '" . (int)$this->CI->session->userdata('user_id') . "' AND " . DB_PREFIX_C . "status = '1' AND " . DB_PREFIX_C . "approved = '1'");
			if ($user_query->num_rows()) {
                            $row = $user_query->row();
                            if (isset($row)) {
                                $user_group_query = $this->CI->db->query("SELECT " . DB_PREFIX_C . "permission, " . DB_PREFIX_C . "name FROM " . DB_PREFIX . "user_group WHERE group_id = '" . (int)$row->ref_group_id . "'");
                                $user_group_query_row = $user_group_query->row();

                                $this->user_id = $row->user_id;
                                $this->username = $row->c_username;
                                $this->fullname = $row->c_fullname;
                                $this->email = $row->c_email;
                                $this->group_name = $user_group_query_row->c_name;
                                $permissions = json_decode($user_group_query_row->c_permission, true);

                                if (is_array($permissions)) {
                                    foreach ($permissions as $key => $value) {
                                        $this->permission[$key] = $value;
                                    }
                                }
                            }
			} 
		} else {
                    $this->logout();
		}
	}
	
	function login($user, $password, $override = false) {
		if ($override) {
			$user_query = $this->CI->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE LOWER(" . DB_PREFIX_C . "username) = " . $$this->CI->db->escape($user) . " AND " . DB_PREFIX_C . "status = '1'");
		} else {
//                    print_r("SELECT * FROM " . DB_PREFIX . "user WHERE LOWER(" . DB_PREFIX_C . "username) = " . $this->CI->db->escape(mb_strtolower($user, 'UTF-8')) . " AND (" . DB_PREFIX_C . "password = SHA1(CONCAT(" . DB_PREFIX_C . "salt, SHA1(CONCAT(" . DB_PREFIX_C . "salt, SHA1(" . $this->CI->db->escape(htmlspecialchars($password, ENT_QUOTES)) . "))))) OR " . DB_PREFIX_C . "password = " . $this->CI->db->escape(md5($password)) . ") AND `" . DB_PREFIX_C . "status` = '1' AND " . DB_PREFIX_C . "approved = '1' ");exit;
            if(extension_loaded('mbstring')) {
                $user_query = $this->CI->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE LOWER(" . DB_PREFIX_C . "username) = " . $this->CI->db->escape(mb_strtolower($user, 'UTF-8')) . " AND (" . DB_PREFIX_C . "password = SHA1(CONCAT(" . DB_PREFIX_C . "salt, SHA1(CONCAT(" . DB_PREFIX_C . "salt, SHA1(" . $this->CI->db->escape(htmlspecialchars($password, ENT_QUOTES)) . "))))) OR " . DB_PREFIX_C . "password = " . $this->CI->db->escape(md5($password)) . ") AND `" . DB_PREFIX_C . "status` = '1' AND " . DB_PREFIX_C . "approved = '1' ");
            } else {
                $user_query = $this->CI->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE LOWER(" . DB_PREFIX_C . "username) = " . $this->CI->db->escape($user) . " AND (" . DB_PREFIX_C . "password = SHA1(CONCAT(" . DB_PREFIX_C . "salt, SHA1(CONCAT(" . DB_PREFIX_C . "salt, SHA1(" . $this->CI->db->escape(htmlspecialchars($password, ENT_QUOTES)) . "))))) OR " . DB_PREFIX_C . "password = " . $this->CI->db->escape(md5($password)) . ") AND `" . DB_PREFIX_C . "status` = '1' AND " . DB_PREFIX_C . "approved = '1' ");
            }
			
		}
//		print_r($user_query->num_rows());exit;
		if ($user_query->num_rows()) {
			$row = $user_query->row();
			if (isset($row)) {
                            $this->CI->session->set_userdata('user_id',$row->user_id);
                            $user_group_query = $this->CI->db->query("SELECT " . DB_PREFIX_C . "permission, " . DB_PREFIX_C . "name FROM " . DB_PREFIX . "user_group WHERE group_id = '" . (int)$row->ref_group_id . "'");
                            $user_group_query_row = $user_group_query->row();

                            $this->user_id = $row->user_id;
                            $this->username = $row->c_username;
                            $this->fullname = $row->c_fullname;
                            $this->email = $row->c_email;
                            $this->group_name = $user_group_query_row->c_name;
                            $permissions = json_decode($user_group_query_row->c_permission, true);

                            if (is_array($permissions)) {
                                foreach ($permissions as $key => $value) {
                                    $this->permission[$key] = $value;
                                }
                            }
                            
                            return true;
			}
		} else {
			return false;
		}
	}
	
	function isLogged() {
            return $this->user_id;
	}
	
	public function getId() {
            return $this->user_id;
	} 
	
	public function getUserName() {
            return $this->username;
	}
        
        public function getFullname() {
            return $this->fullname;
	}
        
        public function getEmail() {
            return $this->email;
	}
        
        public function getGroupName() {
            return $this->group_name;
	}
	
	public function hasPermission($key, $value) {
            if (isset($this->permission[$key])) {
                return in_array($value, $this->permission[$key]);
            } else {
                return false;
            }
	}
	
	public function logout() {
            $this->CI->session->unset_userdata('user_id');

            $this->user_id = '';
            $this->username = '';
	}
}