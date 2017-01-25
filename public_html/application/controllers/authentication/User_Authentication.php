<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_Authentication
 *
 * @author bibmathe
 */
class User_Authentication extends CI_Controller {

    var $googleLibrary ;
    var $googleAuthService ;
    var $googleClientId = '8831022929-deeeq5c062p6hq2t16bqmh5hdl8qjmme.apps.googleusercontent.com';
    var $googleClientSecret = '_8RL2mhZrhJ_JaogMYlpuHxv';
    var $gClient;
    var $facebookLibrary;
    var $appId = '1818797898393763';
    var $appSecret = 'f154ebeb5e68aeb8cf75e3568bfa9c6f';
    var $fbPermissions = 'email';

    function __construct() {
        parent::__construct();
         $this->googleLibrary = APPPATH . "libraries/google-api-php-client/Google_Client.php";
        $this->googleAuthService = APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        $this->facebookLibrary = APPPATH . "libraries/facebook-api-php-codexworld/facebook.php";
        include_once $this->googleLibrary;
        $this->gClient = new Google_Client();
        $this->gClient->setApplicationName('Login to idreamlocal.com');
        // Load user model
        $this->load->helper('url');
        $this->load->model('user/user_model');

        $this->load->helper('form');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

        $this->load->model('user/dreamon_self_user_model');
    }

    public function customLogin() {
        $this->form_validation->set_rules('user_name', 'user_name', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $data['userData'] = array();
        if ($this->form_validation->run() == FALSE) {
        
           echo validation_errors();
          
        }else {
        $data = array(
            'email' => $this->input->post('user_name'),
            'password' => $this->input->post('password')
        );

        $result = $this->dreamon_self_user_model->login($data);
        if ($result) {
            $user = $this->dreamon_self_user_model->getDetails($data);
            $data['userData'] = $user;
            /*$this->session->set_userdata('userData', $user);
            $this->load->view('frontpage/include');
            $this->load->view('header/main_header');
            $this->load->view('navigation/navigation', $data);
            $this->load->view('frontpage/content');
            $this->load->view('frontpage/footer');
            $this->load->view('footer/footer');
             * 
             */
            echo "ok";
        } else {
           /* $data = array(
                'error_message' => 'Invalid Username or Password');
                      $this->load->view('currentaffairs/include');
                       $this->load->view('header/main_header');
                       $this->load->view('navigation/navigation');
                       
			 $this->load->view('user_authentication/login_view', $data);
			$this->load->view('footer/footer');
            * */
            echo "Invalid Username or Password";
           
        }
        }
    }

    public function clogout() {

// Removing session data
        $sess_array = array('first_name' => '', 'email'=> '');
        $this->session->unset_userdata('userData', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('user_authentication/login_view', $data);
        }

       

        public function googleLogin() {
        // Include the google api php libraries
        include_once $this->googleLibrary;
        include_once $this->googleAuthService;

        // Google Project API Credentials

        $redirectUrl = base_url() . 'authentication/User_Authentication/googleLogin';

        $this->gClient->setClientId($this->googleClientId);
        $this->gClient->setClientSecret($this->googleClientSecret);
        $this->gClient->setRedirectUri($redirectUrl);


        $google_oauthV2 = new Google_Oauth2Service($this->gClient);

        if (isset($_GET['code'])) {
        $this->gClient->authenticate();
        $this->session->set_userdata('token', $this->gClient->getAccessToken());
        redirect($redirectUrl);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $this->gClient->setAccessToken($token);
        }

        if ($this->gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['given_name'];
            $userData['last_name'] = $userProfile['family_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = $userProfile['link'];
            $userData['picture_url'] = $userProfile['picture'];
            // Insert or update user data
            $userID = $this->user_model->checkUser($userData);
            if (!empty($userID)) {
                $data['userData'] = $userData;
                $this->session->set_userdata('userData', $userData);
                redirect('/');
            } else {
                $data['userData'] = array();
            }
        } else {
            $data['authUrl'] = $this->gClient->createAuthUrl();
        }
        $this->load->view('frontpage/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation', $data);
        $this->load->view('frontpage/content');
        $this->load->view('frontpage/footer');
        $this->load->view('footer/footer');
    }

    public function facebooklogin() {
        // Include the facebook api php libraries

        include $this->facebookLibrary;
        // Facebook API Configuration
        $fbredirectUrl = base_url() . 'authentication/User_Authentication/facebooklogin';
        $facebook = new Facebook(array(
            'appId' => $this->appId,
            'secret' => $this->appSecret
        ));

        $data['userData'] = array();

        if (isset($_GET['code'])) {
            $access_code = $facebook->getAccessToken();
            $this->session->set_userdata('token', $access_code);
            $userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/' . $userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
            // Insert or update user data
            $userID = $this->user_model->checkUser($userData);
            if (!empty($userID)) {
                $data['userData'] = $userData;
                $this->session->set_userdata('userData', $userData);
            }
        }


        $fbPermissions = 'email';
        // $fbuser = $facebook->getUser();



        $data['fauthUrl'] = $facebook->getLoginUrl(array('redirect_uri' => $fbredirectUrl, 'scope' => $fbPermissions));
        $data['authUrl'] = $this->getGoogleUrl();

        $this->load->view('frontpage/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation', $data);
        $this->load->view('frontpage/content');
        $this->load->view('frontpage/footer');
        $this->load->view('footer/footer');
    }

    
    public function  forgotpasswordform (){
         $this->form_validation->set_rules('lost_email', 'lost_email', 'required|valid_email|min_length[5]|max_length[125]');
         if ($this->form_validation->run() == FALSE) {
             echo 'Email is not Valid';
         }
         else {
           $email = $this->input->post('lost_email');
           if($this->dreamon_self_user_model->validEmail($email)){
                 if( $this->dreamon_self_user_model->resetPassEmail($email) )  
                     echo "ok";
                else 
                   echo "Unknown error in sending email";
                
           }else{
                echo "Invalid Email address";
                
           }
           
         }
         
    }
    
    public function newPasswordform(){
         $this->form_validation->set_rules('code', 'Code', 'required|min_length[4]|max_length[7]');
    $code = $this->input->post('code');
    $this->form_validation->set_rules('Pass', 'Password', 'trim|required|md5|min_length[5]');
    $this->form_validation->set_rules('CPass', 'Confirmation Password', 'trim|required|md5|min_length[5]|matches[Pass]');
    if ($this->form_validation->run() == FALSE) {
              
               $data = array(
                'code' => $code);
               
                $this->showNewPassPage($data)   ;
         }
         
         if($this->dreamon_self_user_model->validCode($code)){
             $pass = $this->input->post('Pass');
              if( $this->dreamon_self_user_model->updatePass($code,$pass) )  {
                   $data = array(
                  'success_message' => 'You have successfully changed your password. Please proceed to Login');
              }else {
                    $data = array(
                 'error_message' => 'There is an Unknown error occured ');
              }
              
          }else { $data = array(
                 'error_message' => 'There is an Unknown error occured ');
          }
          
            $this->showNewPassPage($data)   ;
         
        
    }
    public function newPassword($code=0){
        if($code==0)
             redirect('/');
        else{
            $data =  array(
                'code' => $code);
              
        }
       $this->showNewPassPage($data)   ;
    }
    
    public function showNewPassPage($data){
              $this->load->view('currentaffairs/include');
              $this->load->view('header/main_header');
              $this->load->view('navigation/navigation');
              $this->load->view('user_authentication/new_password' , $data);
	      $this->load->view('footer/footer'); 
    }
    public function forgotPassword(){
            $this->load->view('currentaffairs/include');
              $this->load->view('header/main_header');
              $this->load->view('navigation/navigation');
              $this->load->view('user_authentication/forgot_password');
	      $this->load->view('footer/footer');
    }
    public function logout() {
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('/');
    }

//put your code here

    public function getGoogleUrl() {
        include_once APPPATH . "libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

        // Google Project API Credentials
        $clientId = '8831022929-deeeq5c062p6hq2t16bqmh5hdl8qjmme.apps.googleusercontent.com';
        $clientSecret = '_8RL2mhZrhJ_JaogMYlpuHxv';
        $redirectUrl = base_url() . 'authentication/User_Authentication/';

        // Google Client Configuration
        $this->gClient = new Google_Client();
        $this->gClient->setApplicationName('Login to idreamlocal.com');
        $this->gClient->setClientId($clientId);
        $this->gClient->setClientSecret($clientSecret);
        $this->gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($this->gClient);
        return $this->gClient->createAuthUrl();  //Google Data
    }

}
