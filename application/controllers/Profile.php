<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//  ;NOTE;
//"b" is Business
//"fi" is Fields
//"e" is Enitity
//"t" is type
class Profile extends CI_Controller {
    private $error = array();
    function __construct(){
        parent::__construct();
        $this->load->library('response');
        $this->load->library('user');
        $this->load->model('account/account');
        $this->load->library('header');
        $this->load->library('footer');
    }
    
    public function index() {
        if (!$this->user->isLogged()) {
            $this->response->redirect('/login');
        }
        if (!$this->user->hasPermission('access', 'profile')) {
            $this->response->redirect('/home');
        }
        $data['title'] = 'Profile';
        $data['heading_title'] = 'Profile';
        $data['base'] = 'Profile';
        $data['url_login'] = false;
        
        
        if (($this->user->isLogged()) && ($this->input->server('REQUEST_METHOD') != 'POST')) {
            $user_info = $this->account->getInfoUser($this->user->getId());	
        }
        
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
            $profile = $this->account->editProfile($this->input->post());
            if($profile) {
                $this->response->redirect('/profile');
            }
        }

        if ($this->input->post('username')) {
                $data['username'] = $this->input->post('username');
        } elseif (!empty($user_info)) {
                $data['username'] = $user_info->c_username;
        } else {
                $data['username'] = '';
        }
        
        $data['action'] = 'profile';
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
        
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        $data['menu_left'] = $this->menu_view->getMenuView();
        $this->response->setOutput($this->load->view('account/profile',$data));
    }
    
    protected function validateForm() {
        
        return !$this->error;
    }
}