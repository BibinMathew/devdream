<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomUser
 *
 * @author bibmathe
 */
class CustomUser extends CI_Controller {
    //put your code here
    
     public function __construct() {
        parent::__construct();
         include APPPATH .'util/authUtil.php' ;
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->library('session');
        $this->load->model('user/dreamon_self_user_model');
       
    }
    
    public function sendEmail(){
        $this->dreamon_self_user_model->sendEmail('bibin.vnit@gmail.com');
    }
     function register()
    {
		//set validation rules
		$this->form_validation->set_rules('register_username', 'User Name', 'trim|required|alpha|min_length[3]|max_length[30]');
		
		$this->form_validation->set_rules('register_email', 'Email ID', 'trim|required|valid_email|is_unique[dreamon_self_user.email]');
		$this->form_validation->set_rules('register_password', 'Password', 'trim|required|md5');
		
		$this->form_validation->set_message('is_unique', 'This %s is already registered');
		
		//validate form input
		if ($this->form_validation->run() == FALSE)
        {
			// fails
			echo validation_errors();

        }
		else
		{
		
		        $passwordForm = $this->input->post('register_password');
			$hashpass = md5($passwordForm);
			//insert the user registration details into database
			$data = array(
				'fname' => $this->input->post('register_username'),
				
				'email' => $this->input->post('register_email'),
				'password' => $hashpass
			);
			
			// insert form data into database
			if ($this->dreamon_self_user_model->insertUser($data))
			{
				// send email
				if ($this->dreamon_self_user_model->sendEmail($this->input->post('register_email')))
				{
					// successfully sent mail
					echo "ok";
				}
				else
				{
					// error
					echo "Oops! Error.  Please try again later!!!";
					
				}
			}
			else
			{
				// error
				echo "Oops! Error.  Please try again later!!!";
			}
		}
	}
	
   public function showHeader($individual){
      
        $auth = new authUtil();
        $data['authUrl'] = $auth->getGoogleUrl();
        $data['fauthUrl']= $auth->getFaceBookUrl();
        
        $this->load->view('bs/include.php');
        $this->load->view($individual);
        $this->load->view('bs/nav.php',$data);
    }
	
	
	
	function verify($hash=NULL)
	{
		if ($this->dreamon_self_user_model->verifyEmailID($hash))
		{
			   $this->session->set_flashdata('verify_msg','Success');
			   $this->showHeader('bs/userpage/include');
                           $this->load->view('bs/userpage/afterverify');
                           $this->load->view('bs/frontpage/footer');
		}
		else
		{
                    
                          $this->session->unset_userdata('verify_msg');
			//$this->session->set_flashdata('verify_msg','<div class="uk-alert uk-alert-danger" data-uk-alert ><a href="" class="uk-alert-close uk-close"></a><p>Sorry! There is error verifying your Email Address!</p></div>');
			   $this->showHeader('bs/userpage/include');
                           $this->load->view('bs/userpage/afterverify');
                           $this->load->view('bs/frontpage/footer');
		}
	}
    
    

    
}
