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
//        $this->load->model('account/promo_model');
        $this->load->library('header');
        $this->load->library('footer');
    }
    
    public function index() {
        $data['title'] = 'Promo Lists';
        $data['heading_title'] = 'Promo Lists';
        $data['base'] = 'Promo Lists';
        $data['url_login'] = false;
        $data['header'] = $this->header->getHeader($data);
        $data['footer'] = $this->footer->getFooter();
        $data['menu_left'] = $this->menu_view->getMenuView();
        $this->response->setOutput($this->load->view('account/profile',$data));
    }
}