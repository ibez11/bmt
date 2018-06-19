<?php
class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
	}
	private $error = array();
	
	function index() {
		$this->load->library('response');
		$this->load->library('user');
                $this->load->library('header');
		if ($this->user->isLogged()) {
                    $this->response->redirect('/');
		}
		
		$data['direction']          = 'ltr';
		$data['lang']               = 'en';
		$data['title']              = 'Login';
		$data['base']               = 'Login';
		$data['description']        = 'sdgdsg';
		$data['keywords']           = 'sdgsgdsg';
		
		$data['link_logo']          = base_url();
		$data['logo']               = 'https://www.gudangvoucher.com/images/_default_header_02.png';
		$data['name']               = 'BMT';
		$data['text_returning_customer'] = 'Welcome';
                $data['text_account_already'] = 'If you already have an account with us, please login at the login page.';
		$data['action']             = 'login';
		$data['user']               = 'User';
		$data['entry_user']         = 'User';
		$data['password']           = 'Password';
		$data['entry_password']     = 'Password';
                $data['forgotten']          = 'forgotten';
                $data['text_forgotten']     = 'Forgotten ?';
                $data['text_register_account'] = sprintf('Don\'t have an account ? <a href="%s">Sign up now!</a>', 'register');
		
		
		if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate()) {
                    $this->response->redirect('/');
		}
                
                if ($this->input->post('username')) {
                    $data['username'] = $this->input->post('username');
                } else {
                    $data['username'] = '';
                }
                
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                } else {
                    $data['password'] = '';
                }
		
		if (isset($this->error['warning'])) {
                    $data['error_warning'] = $this->error['warning'];
		} else {
                    $data['error_warning'] = '';
		}
		$data['url_login'] = true;
                $data['title'] = 'Login';
                $data['heading_title'] = 'Login';
                $data['base'] = 'Login';
                $data['header'] = $this->header->getHeader($data);
		$this->load->view('login',$data);
	}
 
	protected function validate() {
            if (!$this->error) {
                if (!$this->user->login($this->input->post('username'), $this->input->post('password'))) {
                    $this->error['warning'] = 'User tidak ada/Password salah';
                }
            }
            return !$this->error;
	}
}