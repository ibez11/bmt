<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller {
    private $error = array();
    function __construct(){
        parent::__construct();
        $this->load->library('response');
        $this->load->library('user');
        $this->load->library('header');
        $this->load->library('footer');
        $this->load->model('account/cashier_model');
        
    }
    public function index() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        if (!$this->user->hasPermission('access', 'cashier')) {
            $this->response->redirect('/home');
        }
        
        if ($this->input->get('sort')) {
            $sort = $this->input->get('sort');
        } else {
            $sort = 'fullname';
        }
        
        
        if ($this->input->get('order')) {
            $order = $this->input->get('order');
        } else {
            $order = 'ASC';
        }
        
        $url = '';
        
        if ($this->input->get('sort')) {
            $url .= '&sort=' . $this->input->get('sort');
        }
        
        if ($order == 'ASC') {
                $url .= '&order=DESC';
        } else {
                $url .= '&order=ASC';
        }
        
        $data['sort_name'] = 'merchant&sort=c.name'.$url;
        $data['sort_parent_id'] = 'merchant&sort=c.ref_parent_id'.$url;
        $data['sort_added_by'] = 'merchant&sort=c.ref_added_id'.$url;
        $data['sort'] = $sort;
        $data['order'] = $order;
        
        $data['cashiers'] = array();
        $results = $this->cashier_model->getCashiers();
        
        foreach($results as $result_) {
            $data['cashiers'][] = array(
                'cashier_id'  => $result_->cashier_id,
                'code_cashier'  => $result_->c_code_cashier,
                'status'  => $result_->c_status ? 'Aktif' : 'Tidak Aktif',
                'name'  => $result_->c_name,
                'date_added'  => $result_->c_date_added,
                'added_by_id'  => $result_->ref_added_by,
                'parent_id'  => $result_->ref_parent_id,
                'parent_name'  => $result_->parent_name,
                'added_by_name'  => $result_->added_by_name,
                'edit'  => $result_->added_by_name
            ); 
        }
        
        if ($this->input->post('selected')) {
                $data['selected'] = (array)$this->input->post('selected');
        } else {
                $data['selected'] = array();
        }
        
        $data['url_login'] = false;
        $data['title'] = 'Cashier';
        $data['heading_title'] = 'Cashier';
        $data['base'] = 'Cashier';
        $data['h3'] = 'Cashier List';
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        
        $this->response->setOutput($this->load->view('cashier/cashier_list',$data));
    }
}