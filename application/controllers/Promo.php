<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//  ;NOTE;
//"b" is Business
//"fi" is Fields
//"e" is Enitity
//"t" is type
class Promo extends CI_Controller {
    private $error = array();
    function __construct(){
        parent::__construct();
        $this->load->library('response');
        $this->load->library('user');
        $this->load->model('account/promo_model');
        $this->load->library('header');
        $this->load->library('footer');
    }
    
    public function index() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        if (!$this->user->hasPermission('access', 'promo')) {
            $this->response->redirect('/home');
        }
        $data['title'] = 'Promo Lists';
        $data['heading_title'] = 'Promo Lists';
        $data['base'] = 'Promo Lists';
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
        
        if ($this->input->post('selected')) {
                $data['selected'] = (array)$this->input->post('selected');
        } else {
                $data['selected'] = array();
        }
        
        $data['sort_name'] = 'merchant&sort=pr.name'.$url;
        $data['sort_group_id'] = 'merchant&sort=u.group_id'.$url;
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['text_no_results'] = 'No results';
        $data['add'] = 'promo/add';
        
        $data['url_login'] = false;
        $data['delete'] = '';
        $data['results_promo'] = array();
        $results = $this->promo_model->getPromosLists();
        foreach($results as $result_) {
            $data['results_promo'][] = array(
                'promo_id' => $result_->promo_id,
                'merchant_fullname'  => $result_->merchant_fullname,
                'name'  => $result_->name,
                'config_mdr_money'  =>  $this->currency->format($result_->config_mdr_money,'IDR'),
                'config_mdr_money_not_curr'  =>  $result_->config_mdr_money,
                'config_mdr_percentage'  => $result_->config_mdr_percentage.'%',
                'start_date'  => $result_->start_date,
                'end_date'  => $result_->end_date,
                'status'  => ($result_->status) ? 'Aktif' : 'Tidak Aktif',
                'edit'  => 'merchant/edit/?user_id='.$result_->promo_id
            ); 
        } 
        
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        $data['menu_left'] = $this->menu_view->getMenuView();
        $this->response->setOutput($this->load->view('promo/promo_list',$data));
    }
    
    public function add() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        if ($this->user->hasPermission('access', 'promo')) {
            $this->response->redirect('/');
        }
        $data['action'] = '/promo/add';
        $data['title'] = 'Promo Add';
        $data['heading_title'] = 'Promo Add';
        $data['base'] = 'Promo Add';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
//            print_r($this->input->post());exit;
            $promo = $this->promo_model->addPromo($this->input->post());
            if($promo) {
                $this->response->redirect('/promo');
            }
        }
        $this->getForm($data);
    }
    
    protected function getForm($data = array()) {
        
        if (($this->input->get('user_id')) && ($this->input->server('REQUEST_METHOD') != 'POST')) {

        }
        
        if ($this->input->post('merchant')) {
                $data['merchant'] = $this->input->post('merchant');
        } elseif (!empty($user_info)) {
                $data['merchant'] = $user_info->c_merchant;
        } else {
                $data['merchant'] = '';
        }
        
        if ($this->input->post('name')) {
                $data['name'] = $this->input->post('name');
        } elseif (!empty($user_info)) {
                $data['name'] = $user_info->c_name;
        } else {
                $data['name'] = '';
        }
        
        if ($this->input->post('mdr')) {
                $data['mdr_money'] = $this->input->post('mdr')[0];
                $data['mdr_percent'] = $this->input->post('mdr')[1];
        } elseif (!empty($user_info)) {
                $data['mdr_money'] = $user_info->c_config_mdr_money;
                $data['mdr_percent'] = $user_info->c_config_mdr_percentage;
        } else {
                $data['mdr_money'] = '';
                $data['mdr_percent'] = '';
        }
        
        if ($this->input->post('status')) {
                $data['status'] = $this->input->post('status');
        } elseif (!empty($user_info)) {
                $data['status'] = $user_info->c_status;
        } else {
                $data['status'] = '';
        }
        
        
        
        //Capture Error
        if (isset($this->error['merchant'])) {
                $data['error_merchant'] = $this->error['merchant'];
        } else {
                $data['error_merchant'] = '';
        }
        
        if (isset($this->error['name'])) {
                $data['error_name'] = $this->error['name'];
        } else {
                $data['error_name'] = '';
        }
        if (isset($this->error['mdr'])) {
                $data['error_mdr'] = $this->error['mdr'];
        } else {
                $data['error_mdr'] = '';
        }
        
        $data['back'] = '/promo';
        
        $data['url_login'] = false;
        
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        $data['menu_left'] = $this->menu_view->getMenuView();
        $this->response->setOutput($this->load->view('promo/promo_form',$data));
    }
    
    public function autocomplete() {
        $json = array();
        $this->load->model('account/merchant_model');
        if ($this->input->get('merchant_name')) {
            $merchant_name = $this->input->get('merchant_name');
        } else {
            $merchant_name = '';
        }
        
        $filter_data = array(
            'merchant_name'  => $merchant_name,
        );
        
        $results = $this->merchant_model->getMerchant($filter_data);
//        print_r($results);
        foreach ($results as $result_) {
            $json[] = array(
                'name'  => $result_->fullname,
                'username'  => $result_->username,
                'user_id'  => $result_->user_id,
                );
        }
//        $this->output->set_content_type('Content-Type: application/json');
//        $this->response->addHeader('Content-Type: application/json');
//        $this->response->setOutput(json_encode($json));
        $this->output->set_output(json_encode($json));
    }
    
    protected function validateForm() {
        return !$this->error;
    }
}