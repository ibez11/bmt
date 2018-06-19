<?php 
 
class Promo_Model extends CI_Model{
    public function getPromosLists() {
        $this->load->library('user');
        $query = $this->db->query("SELECT pr.promo_id,pr." . DB_PREFIX_C . "status as status, (SELECT " . DB_PREFIX_C . "fullname FROM " . DB_PREFIX ."user u1 WHERE u1.user_id = pr." . DB_PREFIX_REF . "merchant_id ) as merchant_fullname,pr." . DB_PREFIX_C . "name as name, pr." . DB_PREFIX_C . "config_mdr_money as config_mdr_money, pr." . DB_PREFIX_C . "config_mdr_percentage as config_mdr_percentage, pr." . DB_PREFIX_C . "start_date as start_date, pr." . DB_PREFIX_C . "end_date as end_date FROM " . DB_PREFIX ."promo pr WHERE pr." . DB_PREFIX_C . "added_by = ".$this->user->getId()." ");
        $rows = $query->result();
        return $rows;
    }
    
    public function addPromo($data = array()) {
        $this->load->library('user');
        $sql = "INSERT INTO `" . DB_PREFIX . "promo` SET " . DB_PREFIX_REF . "merchant_id = ".$data['merchant_id']."," . DB_PREFIX_C . "name = ".$this->db->escape($data['name']).", " . DB_PREFIX_C . "config_mdr_money = ".(float)$data['mdr'][0].", " . DB_PREFIX_C . "config_mdr_percentage = ".(float)$data['mdr'][1].", " . DB_PREFIX_C . "start_date = ".$this->db->escape($data['start_date']).", " . DB_PREFIX_C . "end_date = ".$this->db->escape($data['end_date']).", " . DB_PREFIX_C . "status = ".(int)$data['status'].", " . DB_PREFIX_C . "added_by = ".(int)$this->user->getId()."  ";
        $this->db->query($sql);
        return true;
    }
}