<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    private $error = array();
    function __construct(){
        parent::__construct();	
        $this->load->model('account/account');
    }

    public function index() {
        $this->load->library('response');
        $this->load->library('user');
        $this->load->library('header');
        
        if ($this->user->isLogged()) {
            $this->response->redirect('/');
        }

        
        
        $data['link_logo'] = base_url();
        $data['logo'] = 'https://www.gudangvoucher.com/images/_default_header_02.png';
        $data['name'] = 'BMT';
        $data['heading_title'] = 'Register';
        $data['text_your_details'] = 'Your Personal Details';
        $data['text_returning_customer'] = 'Welcome';
        $data['action'] = 'register';
        $data['user'] = 'User';
        $data['entry_user'] = 'User';
        $data['entry_email'] = 'Email';
        $data['entry_password'] = 'Password';
        $data['entry_username'] = 'Username';
        $data['entry_fullname'] = 'Nama Lengkap';
        $data['entry_telephone'] = 'Nomor telephone';
        $data['entry_address'] = 'Alamat';
        $data['text_male'] = 'Male';
        $data['text_female'] = 'Female';
        $data['gender_male'] = 'checked';
        $data['gender_female'] = '';
        $data['button_continue_register'] = 'Register Account';;
        $data['text_account_already'] = sprintf('If you already have an account with us, please login at the <a href="%s">login page</a>.', 'login');


        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate()) {
            $user_id = $this->account->addUser($this->input->post());
            if($user_id) {
                $this->response->redirect('/login');
            }
            
        }
        
        if ($this->input->post('fullname')) {
                $data['fullname'] = $this->input->post('fullname');
        } else {
                $data['fullname'] = '';
        }
        
        if ($this->input->post('username')) {
                $data['username'] = $this->input->post('username');
        } else {
                $data['username'] = '';
        }
        
        if ($this->input->post('email')) {
                $data['email'] = $this->input->post('email');
        } else {
                $data['email'] = '';
        }
        
        if ($this->input->post('telephone')) {
                $data['telephone'] = $this->input->post('telephone');
        } else {
                $data['telephone'] = '';
        }

        if ($this->input->post('address')) {
                $data['address'] = $this->input->post('address');
        } else {
                $data['address'] = '';
        }
        
        if ($this->input->post('password')) {
                $data['password'] = $this->input->post('password');
        } else {
                $data['password'] = '';
        }
        
        if (isset($this->error['email'])) {
                $data['error_email'] = $this->error['email'];
        } else {
                $data['error_email'] = '';
        }

        if (isset($this->error['telephone'])) {
                $data['error_telephone'] = $this->error['telephone'];
        } else {
                $data['error_telephone'] = '';
        }

        if (isset($this->error['address'])) {
                $data['error_address'] = $this->error['address'];
        } else {
                $data['error_address'] = '';
        }
        
        if (isset($this->error['username'])) {
                $data['error_username'] = $this->error['username'];
        } else {
                $data['error_username'] = '';
        }
        
        if (isset($this->error['fullname'])) {
                $data['error_fullname'] = $this->error['fullname'];
        } else {
                $data['error_fullname'] = '';
        }
        
        if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
        } else {
                $data['error_warning'] = '';
        }
        
        if (isset($this->error['password'])) {
                $data['error_password'] = $this->error['password'];
        } else {
                $data['error_password'] = '';
        }

        if (isset($this->error['confirm'])) {
                $data['error_confirm'] = $this->error['confirm'];
        } else {
                $data['error_confirm'] = '';
        }
        
        $data['url_login'] = true;
        $data['title'] = 'Register';
        $data['heading_title'] = 'Register';
        $data['base'] = 'Register';
        $data['header'] = $this->header->getHeader($data);

        $this->load->view('register',$data);
    }
        
    protected function validate() {
        if ((strlen(trim($this->input->post('fullname'))) < 3) ) {
            $this->error['fullname'] = 'Fullname';
        }
        
        if ((strlen($this->input->post('email')) > 96) || !filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = 'Email salah';
        }

        if (empty($this->input->post('address'))) {
            $this->error['email'] = 'Address salah';
        }
        
        if ($this->account->getTotalAccountByUsername($this->input->post('username'))) {
			$this->error['warning'] = 'Username sudah dipakai';
		}
        
        if ((strlen($this->input->post('password')) < 6)) {
            $this->error['password'] = 'Password salah';
        }
                
        return !$this->error;
    }
}