<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of authUtil
 *
 * @author bibmathe
 */
class authUtil {

    //put your code here


    var $googleLibrary ;
    var $googleAuthService ;
    var $googleClientId = '8831022929-deeeq5c062p6hq2t16bqmh5hdl8qjmme.apps.googleusercontent.com';
    var $googleClientSecret = '_8RL2mhZrhJ_JaogMYlpuHxv';
    var $gClient;
    var $facebookLibrary;
    var $appId = '1818797898393763';
    var $appSecret = 'f154ebeb5e68aeb8cf75e3568bfa9c6f';
    var $fbPermissions = 'email';

    public function __construct() {
       
       
        $this->googleLibrary =  APPPATH . "libraries/google-api-php-client/Google_Client.php";
        $this->googleAuthService  = APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        $this->facebookLibrary  =  APPPATH . "libraries/facebook-api-php-codexworld/facebook.php";
         include_once $this->googleLibrary;
        $this->gClient = new Google_Client();
        $this->gClient->setApplicationName('Login to idreamlocal.com');
        // Load user model
       
    }

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

    public function logout() {

// Removing session data
        $sess_array = array('first_name' => '', 'email' => '');
        $this->session->unset_userdata('userData', $sess_array);
        $this->load->view('/', $data);
    }

    public function getFaceBookUrl() {
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



        return $facebook->getLoginUrl(array('redirect_uri' => $fbredirectUrl, 'scope' => $fbPermissions));
    }

}
