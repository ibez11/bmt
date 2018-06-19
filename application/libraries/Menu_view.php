<?php
class Menu_View {
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('user');
        $this->CI->load->library('menu');
    }
    
    function getMenuView() {
        $data_menu_left['fullname'] = $this->CI->user->getFullname();
        $data_menu_left['level'] = $this->CI->user->getGroupName();
        $data_menu_left['welcome_back'] = 'Welcome back';
        $data_menu_left['test'] = '';
        $data_menu_left['dashboard'] = 'Dashboard';
        $data_menu_left['account'] = 'Account';
        $data_menu_left['link_dashboard'] = '/'; 
        
        $data_menu_left['menus'] = $this->CI->menu->getMenu();
        return $this->CI->load->view('common/menu_left', $data_menu_left, TRUE);
    }
}