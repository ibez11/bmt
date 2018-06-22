<?php
class Menu {
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('user');
        // Menu
        $data[] = array(
            'id'       => 'menu-dashboard',
            'icon'	   => 'fa-dashboard',
            'name'	   => 'Dashboard',
            'href'     => '/',
            'children' => array()
        );

        // Catalog
        $catalog = array();

        if ($this->CI->user->hasPermission('access', 'merchant')) {
            $catalog[] = array(
                'name'     => 'Merchant',
                'href'     => '/merchant',
                'children' => array()		
            );
        }
        
        if ($this->CI->user->hasPermission('access', 'cashier')) {
            $catalog[] = array(
                'name'     => 'Kasir',
                'href'     => '/cashier',
                'children' => array()		
            );
        }
        
        if ($this->CI->user->hasPermission('access', 'promo')) {
            $catalog[] = array(
                'name'     => 'Promo',
                'href'     => '/promo',
                'children' => array()		
            );
        }

        if ($catalog) {
            $data[] = array(
                'id'       => 'menu-catalog',
                'icon'     => 'fa-tags', 
                'name'     => 'Catalog',
                'href'     => '',
                'children' => $catalog
            );		
        }

        //Account
        $account = array();

        if ($this->CI->user->hasPermission('access', 'account')) {
            $account[] = array(
                'name'     => 'Profile',
                'href'     => '/profile',
                'children' => array()		
            );
        }

        if ($account) {
            $data[] = array(
                'id'       => 'menu-account',
                'icon'     => 'fa-user', 
                'name'     => 'Account',
                'href'     => '',
                'children' => $account
            );		
        }

        //Report
        if ($this->CI->user->hasPermission('access', 'report')) {
            $data[] = array(
                'id'       => 'menu-report',
                'icon'     => 'fa-bar-chart-o', 
                'name'     => 'Transaction Report',
                'href'     => '../report',
                'children' => ''
            );		
        }
        
        return $data;
    }
    
    function getMenu() {
        // Menu
        $data[] = array(
            'id'       => 'menu-dashboard',
            'icon'	   => 'fa-dashboard',
            'name'	   => 'Dashboard',
            'href'     => '/',
            'children' => array()
        );

        // Catalog
        $catalog = array();

        if ($this->CI->user->hasPermission('access', 'merchant')) {
            $catalog[] = array(
                'name'     => 'Merchant',
                'href'     => '/merchant',
                'children' => array()		
            );
        }
        
        if ($this->CI->user->hasPermission('access', 'cashier')) {
            $catalog[] = array(
                'name'     => 'Kasir',
                'href'     => '/cashier',
                'children' => array()		
            );
        }
        
        if ($this->CI->user->hasPermission('access', 'promo')) {
            $catalog[] = array(
                'name'     => 'Promo',
                'href'     => '/promo',
                'children' => array()		
            );
        }
        

        if ($catalog) {
            $data[] = array(
                'id'       => 'menu-catalog',
                'icon'     => 'fa-tags', 
                'name'     => 'Catalog',
                'href'     => '',
                'children' => $catalog
            );		
        }

        //Account
        $account = array();

        if ($this->CI->user->hasPermission('access', 'account')) {
            $account[] = array(
                'name'     => 'Profile',
                'href'     => '/profile',
                'children' => array()		
            );
        }

        if ($account) {
            $data[] = array(
                'id'       => 'menu-account',
                'icon'     => 'fa-user', 
                'name'     => 'Account',
                'href'     => '',
                'children' => $account
            );		
        }

        //Report
        if ($this->CI->user->hasPermission('access', 'report')) {
            $data[] = array(
                'id'       => 'menu-report',
                'icon'     => 'fa-bar-chart-o', 
                'name'     => 'Transaction Report',
                'href'     => '/report',
                'children' => ''
            );		
        }
        
        return $data;
    }
}