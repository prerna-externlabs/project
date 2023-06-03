<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel  extends CI_Model {

    function checkuser($email,$password){
       $query= $this->db->query("select * from users where email='$email' AND password = '$password'");
       if($query->num_rows()==1){
        return $query->row();

       }
       else{
        return false;
       }
    }

    function checkcurrentpassword($currentPassword){
        $userid = $this->session->userdata('LoginSession')['id'];
        $query= $this->db->query("select * from users where id='$userid' AND password ='$currentPassword'");
        if($query->num_rows()==1){
         return true;
 
        }
        else{
         return false;
        }
     }

     function updatepassword($password){
      $userid = $this->session->userdata('LoginSession')['id'];
      $this->db->query("update users set password ='$password' where id='$userid' ");
   }

   function validateemail($email){
      
      $query= $this->db->query("select * from users where email ='$email'");
      if($query->num_rows()==1){
       return $query->row();

      }
      else{
       return false;
      }
   }

      function updatepasshash($data,$email){
         $this->db->where('email',$email);
         $this->db->update('users',$data);
      }

      function getHahsDetails($hash){
         $query= $this->db->query("select * from users where hash_key ='$hash'");
         if($query->num_rows()==1){
          return $query->row();
   
         }
         else{
          return false;
         }
      }

      function validateCurrentPassword($currentPassword,$hash)
	{
		$query = $this->db->query("SELECT * FROM users WHERE password='$currentPassword' AND hash_key='$hash'");
		if($query->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updateNewPassword($data,$hash)
	{
		$this->db->where('hash_key',$hash);
		$this->db->update('users',$data);
	}




   

}