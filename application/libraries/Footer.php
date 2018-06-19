<?php
class Footer {
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    function getFooter() {
        return $this->CI->load->view('common/footer', '', TRUE);
    }
}