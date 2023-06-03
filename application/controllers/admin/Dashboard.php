<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
	
	function __construct()
    {
        parent::__construct();
        
    }

	public function index()
	{
		$this->load->view('dashboard');
	}


	public function changepassword(){
		if($_SERVER['REQUEST_METHOD']=='POST'){

			$this->form_validation->set_rules('currentPassword','currentPassword','required');
			$this->form_validation->set_rules('password','password','required');
			$this->form_validation->set_rules('cpassword','cpassword','required|matches[password]');

			if($this->form_validation->run() == true){

				$currentPassword = $this->input->post('currentPassword');
				$encryptCurrentPassword = sha1($currentPassword);
				
				$this->load->model('Usermodel');
			    $check = $this->Usermodel->checkcurrentpassword($encryptCurrentPassword);
				if($check == true){
					$newPassword = $this->input->post('password');
					$encryptPassword = sha1($newPassword );
					$this->Usermodel->updatepassword($encryptPassword);
					$this->session->set_userdata('success','password change succesfully');
					redirect(base_url('admin/dashboard/changepassword'));

				}else{
					$this->session->set_userdata('error','current password is wrong');
					redirect(base_url('admin/dashboard/changepassword'));
				}
			}
			else{
				$this->load->view('change_password');
			}
			
			   
		}else{
			$this->load->view('change_password');
		}
		
	}

}
