<?php
class Header {
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('menu_view');
    }
    
    function getHeader($data = array()) {
        $data['direction'] = 'ltr';
        $data['lang'] = 'en';
        $data['title'] = $data['title'];
        $data['heading_title'] = $data['heading_title'];
        $data['base'] = $data['base'];
        $data['description'] = 'BMT';
        $data['keywords'] = 'BMT';
        $data['menu_left'] = $this->CI->menu_view->getMenuView();
        $data['url_login'] = $data['url_login'];
        return $this->CI->load->view('common/header', $data, TRUE);
    }
}