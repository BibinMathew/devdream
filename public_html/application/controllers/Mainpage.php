<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mainpage
 *
 * @author bibmathe
 */
class Mainpage extends CI_Controller {

    //put your code here
     var $googleLibrary ;
    var $googleAuthService ;
    var $googleClientId = '8831022929-deeeq5c062p6hq2t16bqmh5hdl8qjmme.apps.googleusercontent.com';
    var $googleClientSecret = '_8RL2mhZrhJ_JaogMYlpuHxv';
    var $gClient;
    var $facebookLibrary;
    var $appId = '1818797898393763';
    var $appSecret = 'f154ebeb5e68aeb8cf75e3568bfa9c6f';


    public function __construct() {
        parent::__construct();
        
         $this->googleLibrary = APPPATH . "libraries/google-api-php-client/Google_Client.php";
        $this->googleAuthService = APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        $this->facebookLibrary = APPPATH . "libraries/facebook-api-php-codexworld/facebook.php";
        include_once $this->googleLibrary;

        $this->gClient = new Google_Client();
        $this->gClient->setApplicationName('Login to idreamlocal.com');
        // Load user model
        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('videos/video_model');
        $this->load->model("currart/curr_art_model");
        $this->load->model("articles/Article_model");
        $this->load->model('thought/thought_model');
          $this->load->library('PHPMailer');
    }
   
   
    public function send($to_email, $subject, $text,$isHtml) {

        $this->phpmailer->IsHTML($isHtml);
        $this->phpmailer->AddAddress($to_email);
        $this->phpmailer->IsMail();
        $this->phpmailer->From = 'webmaster@idreamias.com';
        $this->phpmailer->FromName = 'IDreamIAS Team';

        $this->phpmailer->Subject = $subject;
        $this->phpmailer->Body = $text;
        $this->phpmailer->Send();
        return true;
    }


   public function contactus(){
     $contactemail = $this->input->post('contactemail');
     $contactsubject = "One Feedback Received";
     $contactmessage = $this->input->post('contactmessage');
     $message = " Message from : ". $contactemail ." : " . $contactmessage ;
     $this->send('emailus@idreamias.com',$contactsubject ,$message,false );
    }
    
    public function getGoogleAuthURL() {

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

    public function index() {


        //Google Data
        

        $data['authUrl'] = $this->getGoogleAuthURL();

        // Include the facebook api php libraries
        include_once APPPATH . "libraries/facebook-api-php-codexworld/facebook.php";

        // Facebook API Configuration
        $appId = '1818797898393763';
        $appSecret = 'f154ebeb5e68aeb8cf75e3568bfa9c6f';
        $redirectUrl = base_url() . 'authentication/User_Authentication/facebooklogin';
        $fbPermissions = 'email';

        //Call Facebook API
        $facebook = new Facebook(array(
            'appId' => $appId,
            'secret' => $appSecret
        ));


        $data['fauthUrl'] = $facebook->getLoginUrl(array('redirect_uri' => $redirectUrl, 'scope' => $fbPermissions));

        $results = $this->video_model->getVideoByTopic(-1);

        $currentaffairs = $this->curr_art_model->getCurrentAffairsByTopic(-1);
        $articles = $this->Article_model->getArticles(-1);
        $today = date("Y-m-d");
        $thought = $this->thought_model->fetchThoughtofDay($today);
        $footer['thoughtOfDay'] = $thought;
        $data['videos'] = $results;

        //  $contentdata['videos']=$results ;
        $currentAdata['articles'] = $currentaffairs;
        $articledata['articles'] = $articles;
        /* $this->load->view('frontpage/include');
          $this->load->view('header/main_header');
          $this->load->view('navigation/navigation',$data);
          $this->load->view('frontpage/content',$contentdata);
          $this->load->view('frontpage/footer',$footer);
          $this->load->view('footer/footer'); */

        $data['frontPage'] ='1';
        
        header('Access-Control-Allow-Origin: *');
        $this->load->view('bs/include.php');
        $this->load->view('bs/frontpage/include.php');
        $this->load->view('bs/nav.php',$data);
        $this->load->view('bs/frontpage/header.php');
        $this->load->view('bs/frontpage/videosection.php', $data);
        $this->load->view('bs/frontpage/currentaffairs.php', $currentAdata);
        $this->load->view('bs/frontpage/articlesection.php', $articledata);
        $this->load->view('bs/frontpage/quizandthought.php',$footer);
        $this->load->view('bs/frontpage/contactus.php');
         $this->load->view('bs/frontpage/footer.php');
    }

}
