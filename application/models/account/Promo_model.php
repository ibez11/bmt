<?php 
 
class Promo_Model extends CI_Model{
    public function getPromosLists() {
        $this->load->library('user');
        $query = $this->db->query("SELECT pr.promo_id,pr." . DB_PREFIX_C . "status as status, (SELECT u1." . DB_PREFIX_C . "fullname FROM " . DB_PREFIX ."user u1 WHERE u1.user_id = pr." . DB_PREFIX_REF . "merchant_id ) as merchant_fullname,pr." . DB_PREFIX_C . "name as name, pr." . DB_PREFIX_C . "config_mdr_money as config_mdr_money, pr." . DB_PREFIX_C . "config_mdr_percentage as config_mdr_percentage, pr." . DB_PREFIX_C . "start_date as start_date, pr." . DB_PREFIX_C . "end_date as end_date FROM " . DB_PREFIX ."promo pr WHERE pr." . DB_PREFIX_C . "added_by = ".$this->user->getId()." ");
        $rows = $query->result();
        return $rows;
    }
    
    public function addPromo($data = array()) {
        $this->load->library('user');
        $sql = "INSERT INTO `" . DB_PREFIX . "promo` SET " . DB_PREFIX_REF . "merchant_id = ".$data['merchant_id']."," . DB_PREFIX_C . "name = ".$this->db->escape($data['name']).", " . DB_PREFIX_C . "config_mdr_money = ".(float)$data['mdr'][0].", " . DB_PREFIX_C . "config_mdr_percentage = ".(float)$data['mdr'][1].", " . DB_PREFIX_C . "start_date = ".$this->db->escape($data['start_date']).", " . DB_PREFIX_C . "end_date = ".$this->db->escape($data['end_date']).", " . DB_PREFIX_C . "status = ".(int)$data['status'].", " . DB_PREFIX_C . "added_by = ".(int)$this->user->getId()."  ";
        $this->db->query($sql);
        return true;
    }

    public function getPromoId($promo_id) {
        $this->load->library('user');
        $query = $this->db->query("SELECT p.*, (SELECT u." . DB_PREFIX_C . "fullname FROM " . DB_PREFIX ."user u WHERE u.user_id = p.". DB_PREFIX_REF ."merchant_id ) as merchant_name, (SELECT u1." . DB_PREFIX_C . "fullname FROM " . DB_PREFIX ."user u1 WHERE u1.user_id = p.". DB_PREFIX_C ."added_by) as added_by_name FROM `" . DB_PREFIX . "promo` p WHERE promo_id = ".$promo_id." ");
        $rows = $query->row();
        return $rows;
    }

    public function editPromo($promo_id,$data = array()) {
        // print_r("UPDATE `" . DB_PREFIX . "promo` SET " . DB_PREFIX_REF . "merchant_id = ".$data['merchant_id']."," . DB_PREFIX_C . "name = ".$this->db->escape($data['name']).", " . DB_PREFIX_C . "config_mdr_money = ".(float)$data['mdr'][0].", " . DB_PREFIX_C . "config_mdr_percentage = ".(float)$data['mdr'][1].", " . DB_PREFIX_C . "start_date = ".$this->db->escape($data['start_date']).", " . DB_PREFIX_C . "end_date = ".$this->db->escape($data['end_date']).", " . DB_PREFIX_C . "status = ".(int)$data['status']."  WHERE promo_id = ".$promo_id." ");exit;
        $query = $this->db->query("UPDATE `" . DB_PREFIX . "promo` SET " . DB_PREFIX_REF . "merchant_id = ".$data['merchant_id']."," . DB_PREFIX_C . "name = ".$this->db->escape($data['name']).", " . DB_PREFIX_C . "config_mdr_money = ".(float)$data['mdr'][0].", " . DB_PREFIX_C . "config_mdr_percentage = ".(float)$data['mdr'][1].", " . DB_PREFIX_C . "start_date = ".$this->db->escape($data['start_date']).", " . DB_PREFIX_C . "end_date = ".$this->db->escape($data['end_date']).", " . DB_PREFIX_C . "status = ".(int)$data['status']."  WHERE promo_id = ".$promo_id." ");
        
        return true;
    }

    public function checkUser($user_id) {
        $sql = "SELECT COUNT(*) as total FROM `" . DB_PREFIX . "user` WHERE user_id = ".$user_id." ";
        $query = $this->db->query($sql);
        $total = $query->row('total');
        return $total; 
    }
}