<?php
class Logout extends CI_Controller{
		
	function index() {
		$this->load->library('response');
		$this->load->library('user');
		$this->user->logout();
		$this->response->redirect('/login');
	}
}	