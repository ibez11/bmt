<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends CI_Controller {
    public function index() {
        
        return $this->load->view('common/footer', '', TRUE);
    }
}