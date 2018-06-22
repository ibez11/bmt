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
        $this->load->helper('apifunction_helper');
        
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
                'edit'  => 'cashier/edit/?cashier_id='.$result_->cashier_id
            ); 
        }
        
        if ($this->input->post('selected')) {
                $data['selected'] = (array)$this->input->post('selected');
        } else {
                $data['selected'] = array();
        }
        
        $data['url_login'] = false;
        $data['title'] = 'Kasir';
        $data['heading_title'] = 'Kasir';
        $data['base'] = 'Kasir';
        $data['h3'] = 'Daftar Kasir';
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        
        $this->response->setOutput($this->load->view('cashier/cashier_list',$data));
    }

    public function add() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        $data['action'] = '/cashier/add';
        $data['title'] = 'Tambah Kasir';
        $data['heading_title'] = 'Tambah Kasir';
        $data['base'] = 'Tambah Kasir';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
            // print_r($this->input->post());exit;
            // $results_codeCashier = $this->getMerchantId();
            $code_cashier['code_cashier'] = 'sdgfsdgsdg76';
            $merge_array = $this->input->post() + $code_cashier;
            // print_r($merge_array);
            $merchant = $this->cashier_model->addCashier($merge_array);
            if($merchant) {
                $this->response->redirect('/cashier');
            }
        }
        $this->getForm($data);
    }

    protected function getForm($data = array()) {
        
        if (($this->input->get('cashier_id')) && ($this->input->server('REQUEST_METHOD') != 'POST')) {
            
                $cashier_info = $this->cashier_model->getCashierId($this->input->get('cashier_id'));	
                if($cashier_info->user_id !=  $this->input->get('user_id')){
                    $this->response->redirect('/cashier');
                }
        }
        
        if ($this->input->post('merchant')) {
                $data['merchant'] = $this->input->post('merchant');
        } elseif (!empty($cashier_info)) {
                $data['merchant'] = $cashier_info->parent_name;
        } else {
                $data['merchant'] = '';
        }

        if ($this->input->post('merchant_id')) {
                $data['merchant_id'] = $this->input->post('merchant_id');
        } elseif (!empty($cashier_info)) {
                $data['merchant_id'] = $promo_info->c_parent_id;
        } else {
                $data['merchant_id'] = '';
        }

        if ($this->input->post('name')) {
                $data['name'] = $this->input->post('name');
        } elseif (!empty($cashier_info)) {
                $data['name'] = $cashier_info->c_name;
        } else {
                $data['name'] = '';
        }
        
        if ($this->input->post('ref_added_by')) {
                $data['ref_added_byd'] = $this->input->post('ref_added_by');
        } elseif (!empty($cashier_info)) {
                $data['ref_added_by'] = $cashier_info->added_by_name;
        } else {
                $data['ref_added_by'] = '';
        }
        
        if ($this->input->post('parent_id')) {
                $data['parent_id'] = $this->input->post('parent_id');
        } elseif (!empty($cashier_info)) {
                $data['parent_id'] = $cashier_info->c_parent_id;
        } else {
                $data['parent_id'] = '';
        }
        
        if ($this->input->post('address')) {
                $data['address'] = $this->input->post('address');
        } elseif (!empty($cashier_info)) {
                $data['address'] = $cashier_info->c_address;
        } else {
                $data['address'] = '';
        }

        if ($this->input->post('status')) {
                $data['status'] = $this->input->post('status');
        } elseif (!empty($cashier_info)) {
                $data['status'] = $cashier_info->c_status;
        } else {
                $data['status'] = '';
        }
        
        
        //Capture Error
        if (isset($this->error['name'])) {
                $data['error_name'] = $this->error['name'];
        } else {
                $data['error_name'] = '';
        }

        if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
        
        
        
        $data['url_login'] = false;
        
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        $data['menu_left'] = $this->menu_view->getMenuView();
        $this->response->setOutput($this->load->view('cashier/cashier_form',$data));
    }

    protected function validateForm() {
        // if(!$this->getMerchantId()) {
        //     $this->error['warning'] = 'Gagal konek ke server';
        // }
        // if ($this->merchant_model->getTotalMerchantByUsername($this->input->post('username'))) {
		// 	$this->error['username'] = 'Username sudah dipakai';
        // }
        if(empty($this->input->post('merchant_id')) ){
            $this->error['warning'] = 'Gagal!! Nama Merchant tidak terdaftar..';
        } else {
            $total = $this->cashier_model->checkUser($this->input->post('merchant_id'));
            if((int)$total == 0){
                $this->error['warning'] = 'Gagal!! Nama Merchant tidak terdaftar..';
            }
        }
        return !$this->error;
    }
}