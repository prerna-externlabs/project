<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $site_title;

	function __construct()
    {
        parent::__construct();
        $this->site_title = 'MY Admin Login';
    }

    

}

class Admin_Controller extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('LoginSession')){
            redirect(base_url('login/index'));
        }
    }
}
