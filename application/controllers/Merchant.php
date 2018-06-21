<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//  ;NOTE;
//"b" is Business
//"fi" is Fields
//"e" is Enitity
//"t" is type
class Merchant extends CI_Controller {
    private $error = array();
    function __construct(){
        parent::__construct();
        $this->load->library('response');
        $this->load->library('user');
        $this->load->library('header');
        $this->load->library('footer');
        $this->load->model('account/merchant_model');
        $this->load->model('tool/tool_image');
    }
    public function index() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        if (!$this->user->hasPermission('access', 'merchant')) {
            $this->response->redirect('/home');
        }

        $data['delete'] = '';

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
        
        $data['sort_fullname'] = 'merchant&sort=u.fullname'.$url;
        $data['sort_group_id'] = 'merchant&sort=u.group_id'.$url;
        $data['sort'] = $sort;
        $data['order'] = $order;
        
        $data['merchants'] = array();
        $results = $this->merchant_model->getMerchant();
        
        foreach($results as $result_) {
            $data['merchants'][] = array(
                'user_id'  => $result_->user_id,
                'fullname'  => $result_->fullname,
                'group_name'  => $result_->group_name,
                'status'  => $result_->status ? 'Aktif' : 'Tidak aktif',
                'date_added'  => $result_->date_added,
                'edit'  => 'merchant/edit/?user_id='.$result_->user_id
            ); 
        } 
        $data['text_no_results'] = 'Tidak ada data';
        $data['url_login'] = false;
        $data['title'] = 'Merchant';
        $data['heading_title'] = 'Merchant';
        $data['base'] = 'Merchant';
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        
        $this->response->setOutput($this->load->view('merchant/merchant_list',$data));
        
    }
    
    public function add() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        $data['action'] = '/merchant/add';
        $data['title'] = 'Merchant Add';
        $data['heading_title'] = 'Merchant Add';
        $data['base'] = 'Merchant Add';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
            $merchant = $this->merchant_model->addMerchant($this->input->post());
            if($merchant) {
                $this->response->redirect('/merchant');
            }
        }
        $this->getForm($data);
    }
    
    public function edit() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        if($this->input->get('user_id')) {
            $user_id = $this->input->get('user_id');
        } else {
            $user_id = 0;
        }
        
        $data['action'] = '/merchant/edit/?user_id='.$user_id;
        $data['title'] = 'Merchant Add';
        $data['heading_title'] = 'Merchant Add';
        $data['base'] = 'Merchant Add';
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
//            print_r($this->input->post());exit;
            $merchant = $this->merchant_model->editMerchant($user_id,$this->input->post());
            if($merchant) {
                $this->response->redirect('/merchant');
            }
        }
        $this->getForm($data);
        
    }
    
    protected function getForm($data = array()) {
        
        if (($this->input->get('user_id')) && ($this->input->server('REQUEST_METHOD') != 'POST')) {
                $user_info = $this->merchant_model->getMerchantId($this->input->get('user_id'));	
                $tobs = json_decode($user_info->c_type_of_business);
//                print_r($user_info->user_id);exit;
                if($user_info->user_id !=  $this->input->get('user_id')){
                    $this->response->redirect('/merchant');
                }
        }
        
        if ($this->input->post('username')) {
                $data['username'] = $this->input->post('username');
        } elseif (!empty($user_info)) {
                $data['username'] = $user_info->c_username;
        } else {
                $data['username'] = '';
        }
        
        if ($this->input->post('password')) {
                $data['password'] = $this->input->post('password');
        } elseif (!empty($user_info)) {
                $data['password'] = $user_info->c_password;
        } else {
                $data['password'] = '';
        }
        
        if ($this->input->post('email')) {
                $data['email'] = $this->input->post('email');
        } elseif (!empty($user_info)) {
                $data['email'] = $user_info->c_email;
        } else {
                $data['email'] = '';
        }
        
        if ($this->input->post('name')) {
                $data['name'] = $this->input->post('name');
        } elseif (!empty($user_info)) {
                $data['name'] = $user_info->c_fullname;
        } else {
                $data['name'] = '';
        }
        
        if ($this->input->post('address')) {
                $data['address'] = $this->input->post('address');
        } elseif (!empty($user_info)) {
                $data['address'] = $user_info->c_address;
        } else {
                $data['address'] = '';
        }
        
        if ($this->input->post('b_e_id')) {
                $data['b_e_id'] = $this->input->post('b_e_id');
        } elseif (!empty($user_info)) {
                $data['b_e_id'] = $user_info->ref_business_entity;        
        } else {
                $data['b_e_id'] = '';
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
        
        if ($this->input->post('b_fi')) {
                $data['b_fi'] = $this->input->post('b_fi');
        } elseif (!empty($user_info)) {
                $data['b_fi'] = $user_info->c_business_field;
        } else {
                $data['b_fi'] = '';
        }
        
        if ($this->input->post('t_o_b')) {
            $data['t_o_b'] = $this->input->post('t_o_b');
        } elseif (!empty($user_info)) {
            $data['t_o_b'] = $tobs->selected->code;
        } else {
            $data['t_o_b'] = '';
        }
        
        if (isset($this->input->post('online')['website'])) {
            
            $data['online_website'] = $this->input->post('online')['website'][0];
        } elseif (!empty($user_info)) {
            $data['online_website'] = $tobs->type_business[0]->website[0];
        } else {
            $data['online_website'] = '';
        }
        
        if (isset($this->input->post('online')['instagram'])) {
            $data['online_instagram'] = $this->input->post('online')['instagram'][0];
        } elseif (!empty($user_info)) {
            $data['online_instagram'] = $tobs->type_business[0]->instagram[0];
        } else {
            $data['online_instagram'] = '';
        }
        
        if (isset($this->input->post('online')['online_bbm'])) {
            $data['online_bbm'] = $this->input->post('online')['bbm'][0];
        } elseif (!empty($user_info)) {
            $data['online_bbm'] = $tobs->type_business[0]->bbm[0];
        } else {
            $data['online_bbm'] = '';
        } 
        
        if (isset($this->input->post('online')['online_twitter'])) {
            $data['online_twitter'] = $this->input->post('online')['twitter'][0];
        } elseif (!empty($user_info)) {
            $data['online_twitter'] = $tobs->type_business[0]->twitter[0];
        } else {
            $data['online_twitter'] = '';
        }
        
        if (isset($this->input->post('online')['facebook'])) {
            $data['online_facebook'] = $this->input->post('online')['facebook'][0];
        } elseif (!empty($user_info)) {
            $data['online_facebook'] = $tobs->type_business[0]->facebook[0];
        } else {
            $data['online_facebook'] = '';
        }
        
        if (isset($this->input->post('online')['kaskus'])) {
            $data['online_kaskus'] = $this->input->post('online')['kaskus'][0];
        } elseif (!empty($user_info)) {
            $data['online_kaskus'] = $tobs->type_business[0]->kaskus[0];
        } else {
            $data['online_kaskus'] = '';
        }
        
        if ($this->input->get('directory')) {
            $data['directory'] = rtrim(DIR_IMAGE . $this->user->getId() . '/' . str_replace(array('../', '..\\', '..'), '', $this->input->get('directory')), '/');
        } else {
            $data['directory'] = DIR_IMAGE . $this->user->getId() . '/';
        }
        
        
        if ($this->input->post('shop_logo')) {
                $data['shop_logo'] = $this->input->post('shop_logo');
        } elseif (!empty($user_info)) {
                $data['shop_logo'] = $user_info->c_shop_logo;
        } else {
                $data['shop_logo'] = '';
        }
        
        if ($this->input->post('document_cooperation')) {
            // print_r($this->input->post('document_cooperation'));
                // $data['document_cooperation'] = $this->input->post('document_cooperation');
                if(pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'docx' || pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'doc') {
                    $generate_cache = $this->tool_image->resize('docx-win-icon.png', 100, 100);
                } else if(pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'jpg' || pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'jpg') {
                    $generate_cache = $this->tool_image->resize('jpg-icon.png', 100, 100);
                } else if(pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'pdf') {
                    $generate_cache = $this->tool_image->resize('Files-Pdf-icon.png', 100, 100);
                } else {
                    $generate_cache = $this->tool_image->resize('Document-icon.png', 100, 100);
                }
                // print_r(DIR_IMAGE . $this->input->post('document_cooperation'));
                $data['document_cooperation'] = $generate_cache;
        } elseif (!empty($user_info)) {
            print_r($user_info->c_document_cooperation);
                if(pathinfo(DIR_IMAGE . $user_info->c_document_cooperation, PATHINFO_EXTENSION) == 'docx' || pathinfo(DIR_IMAGE . $user_info->c_document_cooperation, PATHINFO_EXTENSION) == 'doc') {
                    $generate_cache = $this->tool_image->resize('docx-win-icon.png', 100, 100);
                } else if(pathinfo(DIR_IMAGE . $user_info->c_document_cooperation, PATHINFO_EXTENSION) == 'jpg' || pathinfo(DIR_IMAGE . $user_info->c_document_cooperation, PATHINFO_EXTENSION) == 'jpg') {
                    $generate_cache = $this->tool_image->resize('jpg-icon.png', 100, 100);
                } else if(pathinfo(DIR_IMAGE . $user_info->c_document_cooperation, PATHINFO_EXTENSION) == 'pdf') {
                    $generate_cache = $this->tool_image->resize('Files-Pdf-icon.png', 100, 100);
                } else {
                    $generate_cache = $this->tool_image->resize('Document-icon.png', 100, 100);
                }
                $data['document_cooperation'] = $user_info->c_document_cooperation;
        } else {
                $data['document_cooperation'] = '';
        }
        
        if ($this->input->post('shop_logo') && is_file(DIR_IMAGE . $this->input->post('shop_logo'))) {
                $data['thumb'] = $this->tool_image->resize($this->input->post('shop_logo'), 100, 100);
        } elseif (!empty($user_info)) {
                $data['thumb'] = $this->tool_image->resize($user_info->c_shop_logo, 100, 100);
        } else {
                $data['thumb'] = $this->tool_image->resize('no_image.png', 100, 100);
        }
        
        $data['get_id'] = $this->user->getId();
        
        if ($this->input->post('document_cooperation') && is_file(DIR_IMAGE . $this->input->post('document_cooperation'))) {
                if(pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'docx' || pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'doc') {
                    $generate_cache = $this->tool_image->resize('docx-win-icon.png', 100, 100);
                } else if(pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'jpg' || pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'jpg') {
                    $generate_cache = $this->tool_image->resize('jpg-icon.png', 100, 100);
                } else if(pathinfo(DIR_IMAGE . $this->input->post('document_cooperation'), PATHINFO_EXTENSION) == 'pdf') {
                    $generate_cache = $this->tool_image->resize('Files-Pdf-icon.png', 100, 100);
                } else {
                    $generate_cache = $this->tool_image->resize('Document-icon.png', 100, 100);
                }
                $data['document_cooperation_path'] = $generate_cache;
        } elseif (!empty($user_info)) {
            $path_document = $user_info->c_document_cooperation;
            if(is_file(DIR_IMAGE . $path_document)) {
                if(pathinfo($path_document, PATHINFO_EXTENSION) == 'docx' || pathinfo($path_document, PATHINFO_EXTENSION) == 'doc') {
                    $generate_cache = $this->tool_image->resize('docx-win-icon.png', 100, 100);
                } else if(pathinfo($path_document, PATHINFO_EXTENSION) == 'jpg' || pathinfo($path_document, PATHINFO_EXTENSION) == 'jpg') {
                    $generate_cache = $this->tool_image->resize('jpg-icon.png', 100, 100);
                } else if(pathinfo($path_document, PATHINFO_EXTENSION) == 'pdf') {
                    $generate_cache = $this->tool_image->resize('Files-Pdf-icon.png', 100, 100);
                } else {
                    $generate_cache = $this->tool_image->resize('Document-icon.png', 100, 100);
                }
                $data['document_cooperation_path'] = $generate_cache;
            } else {
                $data['document_cooperation_path'] = $this->tool_image->resize('upload_document.png', 100, 100);
            }
        } else {
                $data['document_cooperation_path'] = $this->tool_image->resize('upload_document.png', 100, 100);
        }
        
        if ($this->input->post('n_p_i_c')) {
                $data['n_p_i_c'] = $this->input->post('n_p_i_c');
        } elseif (!empty($user_info)) {
                $data['n_p_i_c'] = $user_info->c_name_pic;
        } else {
                $data['n_p_i_c'] = '';
        }
        
        if ($this->input->post('identity_responsible')) {
                $data['identity_responsible'] = $this->input->post('identity_responsible');
        } elseif (!empty($user_info)) {
                $data['identity_responsible'] = $user_info->c_identity_responsible;
        } else {
                $data['identity_responsible'] = '';
        }
        
        if ($this->input->post('identity_number')) {
                $data['identity_number'] = $this->input->post('identity_number');
        } elseif (!empty($user_info)) {
                $data['identity_number'] = $user_info->c_identity_number;
        } else {
                $data['identity_number'] = '';
        }
        
        $data['placeholder'] = $this->tool_image->resize('no_image.png', 100, 100);
        $data['placeholderdoc'] = $this->tool_image->resize('upload_document.png', 100, 100);
        
        
        //Capture Error
        if (isset($this->error['username'])) {
                $data['error_username'] = $this->error['username'];
        } else {
                $data['error_username'] = '';
        }
        
        if (isset($this->error['password'])) {
                $data['error_password'] = $this->error['password'];
        } else {
                $data['error_password'] = '';
        }
        
        if (isset($this->error['email'])) {
                $data['error_email'] = $this->error['email'];
        } else {
                $data['error_email'] = '';
        }
        
        if (isset($this->error['name'])) {
                $data['error_name'] = $this->error['name'];
        } else {
                $data['error_name'] = '';
        }
        
        if (isset($this->error['address'])) {
                $data['error_address'] = $this->error['address'];
        } else {
                $data['error_address'] = '';
        }
        
        if (isset($this->error['b_e_id'])) {
                $data['error_b_e_id'] = $this->error['b_e_id'];
        } else {
                $data['error_b_e_id'] = '';
        }
        
        if (isset($this->error['b_fi'])) {
                $data['error_b_fi'] = $this->error['b_fi'];
        } else {
                $data['error_b_fi'] = '';
        }
        
        
        
        $data['business_entities'] = array();
        $business_entity_results = $this->merchant_model->getBusinessEntity();
        
        foreach($business_entity_results as $business_entity_result) {
            $data['business_entities'][] = array(
                'b_e_id'        => $business_entity_result->b_e_id,
                'name'        => $business_entity_result->c_name,
            );
        }
        
        $data['url_login'] = false;
        
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        $data['menu_left'] = $this->menu_view->getMenuView();
        $this->response->setOutput($this->load->view('merchant/merchant_form',$data));
    }
    
    protected function validateForm() {
        if ($this->merchant_model->getTotalMerchantByUsername($this->input->post('username'))) {
			$this->error['username'] = 'Username sudah dipakai';
		}
        return !$this->error;
    }
}