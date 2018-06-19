<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->library('response');
                $this->load->library('user');
                
                $this->load->library('header');
                $this->load->library('menu_view');
                $this->load->library('footer');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

            if (!$this->user->isLogged()) {
                $this->response->redirect('/login');
            }
            if ($this->user->getId()) {
                $directory = DIR_IMAGE ;
                if (!is_dir($directory . '/' . $this->user->getId())) {
                    mkdir($directory . '/' . $this->user->getId(), 0777);
                }		
            }
            
            $data['url_login'] = false;
            $data['title'] = 'Home';
            $data['heading_title'] = 'Home';
            $data['base'] = 'Home';
            $data['header'] = $this->header->getHeader($data);
            $data['footer'] = $this->footer->getFooter();
            
            $this->response->setOutput($this->load->view('home',$data));
            
	}
}
