<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menuleft extends CI_Controller {
    public function index() {
        $this->load->library('user');
//        
        $data['fullname'] = $this->user->getFullname();
        $data['level'] = $this->user->getGroupName();
        $data['welcome_back'] = 'Welcome back';
        $data['test'] = '';
        $data['dashboard'] = 'Dashboard';
        $data['account'] = 'Account';
        $data['link_dashboard'] = '/'; 
        $data['link_genealogy'] = '';

        // Menu
        $data['menus'][] = array(
            'id'       => 'menu-dashboard',
            'icon'	   => 'fa-dashboard',
            'name'	   => 'Dashboard',
            'href'     => '/',
            'children' => array()
        );

        // Catalog
        $catalog = array();

        if ($this->user->hasPermission('access', 'merchant')) {
            $catalog[] = array(
                'name'     => 'Merchant',
                'href'     => 'merchant',
                'children' => array()		
            );
        }

        if ($this->user->hasPermission('access', 'branch')) {
            $catalog[] = array(
                'name'     => 'Branch',
                'href'     => 'Branch',
                'children' => array()		
            );
        }

        if ($catalog) {
            $data['menus'][] = array(
                'id'       => 'menu-catalog',
                'icon'     => 'fa-tags', 
                'name'     => 'Catalog',
                'href'     => '',
                'children' => $catalog
            );		
        }

        //Account
        $account = array();

        if ($this->user->hasPermission('access', 'account')) {
            $account[] = array(
                'name'     => 'Profile',
                'href'     => 'profile',
                'children' => array()		
            );
        }

        if ($account) {
            $data['menus'][] = array(
                'id'       => 'menu-account',
                'icon'     => 'fa-user', 
                'name'     => 'Account',
                'href'     => '',
                'children' => $account
            );		
        }

        //Report
        if ($this->user->hasPermission('access', 'report')) {
            $data['menus'][] = array(
                'id'       => 'menu-report',
                'icon'     => 'fa-bar-chart-o', 
                'name'     => 'Transaction Report',
                'href'     => 'report',
                'children' => ''
            );		
        }

        return $this->load->view('common/menu_left', $data);
    }
}