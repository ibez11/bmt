<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header extends CI_Controller {
    public function index() {
//        $this->load->library('user');
//        if (!$this->user->isLogged()) {
//            $this->response->redirect('/login');
//        }
//        $data['fullname'] = $this->user->getFullname();
//        $data['level'] = $this->user->getGroupName();
        $data['direction'] = 'ltr';
        $data['lang'] = 'en';
        $data['title'] = 'Home';
        $data['base'] = 'Home';
        $data['description'] = 'BMT';
        $data['keywords'] = 'BMT';
        $data['url_login'] = false;
        return $this->load->view('common/header', $data, TRUE);
    }
}