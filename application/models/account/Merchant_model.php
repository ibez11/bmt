<?php 
 
class Merchant_Model extends CI_Model{
    public function getMerchant($data = array()) {
        $this->load->library('user');
        $sql = "SELECT u.user_id as user_id,u." . DB_PREFIX_C . "status as status, u." . DB_PREFIX_C . "username as username,u." . DB_PREFIX_C . "date_added as date_added,u." . DB_PREFIX_C . "fullname as fullname,ug." . DB_PREFIX_C . "name as group_name FROM `" . DB_PREFIX . "user` u LEFT JOIN `" . DB_PREFIX . "user_group` ug ON (u." . DB_PREFIX_REF . "group_id = ug.group_id) WHERE u." . DB_PREFIX_C . "parent_id = ".(int)$this->user->getId()." AND u." . DB_PREFIX_REF . "group_id = 2 ";
        if (!empty($data['merchant_name'])) {
            $sql .= " AND u." . DB_PREFIX_C . "fullname LIKE " . $this->db->escape($data['merchant_name']. "%").  "";
        }
//        print_r($sql);
        $query = $this->db->query($sql);
        $rows = $query->result();
        return $rows;
    }
    
    public function getBusinessEntity() {
        $query = $this->db->query("SELECT b_e_id," . DB_PREFIX_C . "name FROM `" . DB_PREFIX . "business_entity` WHERE " . DB_PREFIX_C . "status = 1 ");
        $rows = $query->result();
        return $rows;
    }
    
    public function addMerchant($data = array()) {
        
        $online = array();
        if((int)$data['t_o_b'] == 1) {
            $online['selected'] = array(
                'name'  => 'online',
                'code'  => $data['t_o_b']
            );
        } else {
            $online['selected'] = array(
                'name'  => 'offline',
                'code'  => $data['t_o_b']
            );
        }
            
        $online['type_business'] = array(
            $data['online']
        );

        $sql = "INSERT INTO `" . DB_PREFIX . "user` SET " . DB_PREFIX_C . "username = ".$this->db->escape(strtolower($data['username'])).", " . DB_PREFIX_C . "salt = " . $this->db->escape($salt = token(9)) . ", " . DB_PREFIX_C . "password = " . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "," . DB_PREFIX_C . "email = ".$this->db->escape($data['email'])."," . DB_PREFIX_C . "fullname = ".$this->db->escape($data['name']).", ref_group_id = 2," . DB_PREFIX_C . "approved = 1," . DB_PREFIX_C . "parent_id = ".(int)$this->user->getId()."," . DB_PREFIX_C . "address = ".$this->db->escape($data['address'])."," . DB_PREFIX_REF . "business_entity = ".(int)$data['b_e_id'].", " . DB_PREFIX_C . "type_of_business = ".$this->db->escape(json_encode($online)).", " . DB_PREFIX_C . "shop_logo = ".$this->db->escape($data['shop_logo']).", " . DB_PREFIX_C . "document_cooperation = ".$this->db->escape($data['document_cooperation'])."," . DB_PREFIX_C . "name_pic = ".$this->db->escape($data['n_p_i_c'])."," . DB_PREFIX_C . "identity_responsible = ".$this->db->escape($data['identity_responsible']).", " . DB_PREFIX_C . "identity_number = ".$this->db->escape($data['identity_number']).", ".(($data['mdr'][1] > 0) ?  DB_PREFIX_C . "config_mdr_percentage = ".(float)$data['mdr'][1]."" : "".DB_PREFIX_C . "config_mdr_money = ".(float)$data['mdr'][0] ).",".DB_PREFIX_C . "business_field = ".$this->db->escape($data['b_fi'])." ";
//        print_r($sql);exit;
        $this->db->query($sql);
        return true;
    }
    
    public function editMerchant($user_id,$data = array()) {
        $online = array();
        if((int)$data['t_o_b'] == 1) {
            $online['selected'] = array(
                'name'  => 'online',
                'code'  => $data['t_o_b']
            );
        } else {
            $online['selected'] = array(
                'name'  => 'offline',
                'code'  => $data['t_o_b']
            );
        }
            
        $online['type_business'] = array(
            $data['online']
        );
        $query_password = $this->db->query("SELECT COUNT(*) as total FROM `" . DB_PREFIX . "user` WHERE user_id = ".(int)$user_id." AND " . DB_PREFIX_C . "password = ".$this->db->escape($data['password'])." ");
        $result_password = $query_password->row();
//        print_r($query_password->row());exit;
        if($result_password->total > 0) {
            $sql = "UPDATE `" . DB_PREFIX . "user` SET " . DB_PREFIX_C . "username = ".$this->db->escape(mb_strtolower($data['username']))."," . DB_PREFIX_C . "email = ".$this->db->escape($data['email'])."," . DB_PREFIX_C . "fullname = ".$this->db->escape($data['name']).", ref_group_id = 2," . DB_PREFIX_C . "approved = 1," . DB_PREFIX_C . "parent_id = ".(int)$this->user->getId()."," . DB_PREFIX_C . "address = ".$this->db->escape($data['address'])."," . DB_PREFIX_REF . "business_entity = ".(int)$data['b_e_id'].", " . DB_PREFIX_C . "type_of_business = ".$this->db->escape(json_encode($online)).", " . DB_PREFIX_C . "shop_logo = ".$this->db->escape($data['shop_logo']).", " . DB_PREFIX_C . "document_cooperation = ".$this->db->escape($data['document_cooperation'])."," . DB_PREFIX_C . "name_pic = ".$this->db->escape($data['n_p_i_c'])."," . DB_PREFIX_C . "identity_responsible = ".$this->db->escape($data['identity_responsible']).", " . DB_PREFIX_C . "identity_number = ".$this->db->escape($data['identity_number']).", ".(($data['mdr'][1] > 0) ?  DB_PREFIX_C . "config_mdr_percentage = ".(float)$data['mdr'][1]."" : "".DB_PREFIX_C . "config_mdr_money = ".(float)$data['mdr'][0] ).",".DB_PREFIX_C . "business_field = ".$this->db->escape($data['b_fi'])." WHERE user_id = ".(int)$user_id." ";
        } else {
            $sql = "UPDATE `" . DB_PREFIX . "user` SET " . DB_PREFIX_C . "username = ".$this->db->escape(mb_strtolower($data['username'])).", " . DB_PREFIX_C . "salt = " . $this->db->escape($salt = token(9)) . ", " . DB_PREFIX_C . "password = " . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "," . DB_PREFIX_C . "email = ".$this->db->escape($data['email'])."," . DB_PREFIX_C . "fullname = ".$this->db->escape($data['name']).", ref_group_id = 2," . DB_PREFIX_C . "approved = 1," . DB_PREFIX_C . "parent_id = ".(int)$this->user->getId()."," . DB_PREFIX_C . "address = ".$this->db->escape($data['address'])."," . DB_PREFIX_REF . "business_entity = ".(int)$data['b_e_id'].", " . DB_PREFIX_C . "type_of_business = ".$this->db->escape(json_encode($online)).", " . DB_PREFIX_C . "shop_logo = ".$this->db->escape($data['shop_logo']).", " . DB_PREFIX_C . "document_cooperation = ".$this->db->escape($data['document_cooperation'])."," . DB_PREFIX_C . "name_pic = ".$this->db->escape($data['n_p_i_c'])."," . DB_PREFIX_C . "identity_responsible = ".$this->db->escape($data['identity_responsible']).", " . DB_PREFIX_C . "identity_number = ".$this->db->escape($data['identity_number']).", ".(($data['mdr'][1] > 0) ?  DB_PREFIX_C . "config_mdr_percentage = ".(float)$data['mdr'][1]."" : "".DB_PREFIX_C . "config_mdr_money = ".(float)$data['mdr'][0] ).",".DB_PREFIX_C . "business_field = ".$this->db->escape($data['b_fi'])." WHERE user_id = ".(int)$user_id." ";
        }
        
//        print_r($sql);exit;
        $this->db->query($sql);
        return true;
    }
    
    public function getMerchantId($user_id) {
        $this->load->library('user');
        $query = $this->db->query("SELECT u.* FROM `" . DB_PREFIX . "user` u LEFT JOIN `" . DB_PREFIX . "user_group` ug ON (u." . DB_PREFIX_REF . "group_id = ug.group_id) LEFT JOIN `" . DB_PREFIX . "business_entity` be ON (u." . DB_PREFIX_REF . "business_entity = be.b_e_id)  WHERE u.user_id = ".(int)$user_id." AND u." . DB_PREFIX_C . "parent_id = ".$this->user->getId()." AND u." . DB_PREFIX_REF . "group_id = 2 ");
        $rows = $query->row();
        return $rows;
    }
    
    public function getTotalMerchantByUsername($username) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE LOWER(" . DB_PREFIX_C . "username) = " . $this->db->escape(strtolower($username)) . "");
        
		return $query->row('total');
	}
}