<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	    public function index()
		{
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				$this->form_validation->set_rules('email','Email','required');
			    $this->form_validation->set_rules('password','Email','required');

				if($this->form_validation->run() == true){
					$email = $this->input->post('email');
				    $password = $this->input->post('password');
				    $encryptPassword = sha1($password);
				    $this->load->model('Usermodel');
				    $status = $this->Usermodel->checkuser($email,$encryptPassword);
				    if($status!=false){
						$data = array(
							'username' => $status->user_name,
						    'email' => $status->email,
						    'id' => $status->id,
					    );
						$this->session->set_userdata('LoginSession',$data);
					    redirect(base_url('admin/dashboard/index'));
					}
					else{
						$this->session->set_userdata('error','email id or password is wrong');
					    redirect(base_url('login/index'));

					}
				}else{
					$this->load->view('login');
				}
			}else{
				$this->load->view('login');
			}
		}

		public function logout(){
			session_unset();
			session_destroy();
			redirect(base_url('login/index'));
			
		}

		public function forgetpassword(){
			$this->load->model('Usermodel');
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$this->form_validation->set_rules('email','Email','required');

				if($this->form_validation->run() == true){
					$email = $this->input->post('email');
					$validateEmail =$this->Usermodel->validateemail($email);
					if($validateEmail != false){
						$row = $validateEmail;
						$user_id = $row->id;

						$string = time().$user_id.$email;
						$hash_string = hash('sha256',$string);
						$currentDate = date('Y-m-d H:i');
						$hash_expiry = date('Y-m-d H:i',strtotime($currentDate. '1 days'));
						$data = array(
							'hash_key' => $hash_string,
							'hash_expiry' => $hash_expiry,
						);
						
						$resetlink = base_url().'reset/password?hash='.$hash_string;
						$message = '<p>your reset password link is here: </p>'.$resetlink;
						$subject = "Password reset link";
						$sentStatus = $this->sendEmail($email,$subject,$message);
						if($sentStatus==true){
							$this->Usermodel->updatepasshash($data,$email);
							$this->session->set_userdata('success','reset password link sent succesfully');
					        redirect(base_url('login/forgetpassword'));

						}
						else{
							$this->session->set_userdata('error','email sending error');
							$this->load->view('forget_password');
					    
						}
					}else{
						$this->session->set_userdata('error','email is invalid!');
						$this->load->view('forget_password');
					    
					}

				}else{
					$this->load->view('forget_password');
				}
			}else{
				$this->load->view('forget_password');
			}
		}

		//email
		public function  sendEmail($email,$subject,$message){
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'skprerna2412@gmail.com',
				'smtp_pass' => 'prerna1224',
				
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);

			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->from('noreply');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send()){
				return true;

			}else{
				return false;

			}


		}
	}
