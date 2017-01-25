<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GoogleFBLoginHelper
 *
 * @author bibmathe
 */
class GoogleFBLoginHelper {
    //put your code here
    
    
    var $googleLibrary = APPPATH."libraries/google-api-php-client/Google_Client.php";
    var $googleAuthService = APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
    
    var $googleClientId = '8831022929-deeeq5c062p6hq2t16bqmh5hdl8qjmme.apps.googleusercontent.com';
    var $googleClientSecret = '_8RL2mhZrhJ_JaogMYlpuHxv';
    var $gClient;
    
    
     var $facebookLibrary = APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
     var   $appId = '1818797898393763';
     var   $appSecret = 'f154ebeb5e68aeb8cf75e3568bfa9c6f';
     
       var $fbPermissions = 'email';
     
       public function getGoogleAuthURL(){
        
        include_once $this->googleLibrary;
         include_once $this->googleAuthService;
        // Google Project API Credentials
         
        $redirectUrl = base_url() . 'authentication/User_Authentication/googleLogin';
         $this->gClient->setClientId($this->googleClientId);
         $this->gClient->setClientSecret($this->googleClientSecret);
         $this->gClient->setRedirectUri($redirectUrl);
        
        // Google Client Configuration
        
        $this->gClient->setClientId($this->googleClientId);
         $this->gClient->setClientSecret($this->googleClientSecret);
         $this->gClient->setRedirectUri($redirectUrl);
         $google_oauthV2 = new Google_Oauth2Service($this->gClient);
        return $this->gClient->createAuthUrl();  
    }
}
