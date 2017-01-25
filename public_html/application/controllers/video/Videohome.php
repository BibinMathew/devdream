<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Videohome
 *
 * @author bibmathe
 */
class Videohome extends CI_Controller {
    //put your code here
     public function __construct() {
        parent::__construct();
        include APPPATH .'util/authUtil.php' ;
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('videos/video_model');
         $this->load->model('tag/tag_model');
         $this->load->library('grocery_CRUD');
    }
    
    public function getTagsForVideo($video_id){
        $tagArray = $this->tag_model->getTagsForVideo($video_id);
        $videoTags = array();
            foreach ($tagArray as $tags){
                $videoTags[] = $tags['tag_name'];
            }
             return $videoTags;
    }
    
    
    public function getMostViewedVideos(){
         return $this->video_model->getMostViewedVideos();
    }
    
    public function getRelatedVideos ($video_id){
       return $this->video_model->getRelatedVideos($video_id);
    }
    public function playVideo($video_id){
        if(isset($topic_id))            throw new Exception ("No Video Found");
            $result = $this->video_model->getVideo($video_id);
            $tagArray = $this->getTagsForVideo($video_id);
            $interArray = Array("Tags" =>$tagArray);
           
            $result= array_merge($result,$interArray);
           
            $data['videodetails'] = $result;
            $data['relatedVideos']= $this->getRelatedVideos($video_id);
            $data['mostviewed'] = $this->getMostViewedVideos();
           
           $this->showHeader('bs/videopage/include');
             
           // $this->load->view('templates/default/sidebar');
         //  $this->load->view('bs/videopage/sidebar');
           $this->load->view('bs/videopage/videosingle',$data);
           $this->load->view('bs/frontpage/footer');
           // $this->load->view('templates/default/videopage',$data);
         //   $this->load->view('templates/default/footer');
      //   $this->load->view('footer/footer');
         
            
    }
    
    public function likeup($videoId){
       echo $this->video_model->uplike($videoId);
    }
    
     public function dislikeup($videoId){
       echo $this->video_model->downLike($videoId);
    }
    
    
    public function showHeader($individual){
        $auth = new authUtil();
        $data['authUrl'] = $auth->getGoogleUrl();
        $data['fauthUrl']= $auth->getFaceBookUrl();
        
        $this->load->view('bs/include.php');
        $this->load->view($individual);
        $this->load->view('bs/nav.php',$data);
    }
    
    
    public function testGetVideosForTags($tag_id){
        print_r( $this->video_model->getVideosForTag($tag_id));
    }
     public  function getVideosForTags($tag_id){
          $result = $this->video_model->getVideosForTag($tag_id);
          
          $data['videos']=$result;
          $this->load->view('videopage/include');
           $this->load->view('header/main_header');
          $this->load->view('navigation/navigation');
           $this->load->view('videopage/sidebar');
         
        
         $this->load->view('videopage/videocontent',$data);
         $this->load->view('footer/footer');
       
    }
    
    public function getVideosForKeyword($keyword){
         $result = $this->video_model->getVideosForKeyword($keyword);
         print_r($result);
    }
    
     public function allTopVideos (){
        $result = $this->video_model->getTopVideos();
        echo json_encode($result);
    }
    public function getVideoByTopic ($topic_id=-1){
        $result = $this->video_model->getVideoByTopic($topic_id);
        echo json_encode($result);
    }
   /* public  function index($topic_id=-1){
           $this->load->view('templates/default/header');
         $this->load->view('templates/default/sidebar');
          $result = $this->video_model->getVideoByTopic($topic_id);
          
          $data['videos']=$result;
        
          $this->load->view('templates/default/content',$data);
          $this->load->view('templates/default/footer');
    }
     
    
  */
    
    public function getLatest(){
        //latest
        return $results = $this->video_model->getVideoByTopic(-1);
         
    }
    public  function index($topic_id=-1){
        //  $result = $this->video_model->getVideoByTopic($topic_id);
         // $data['videos']=$result;
          $data['latest']= $this->getLatest();
          $data['top']= $this->video_model->getTopVideos();
           $this->showHeader('bs/videopage/include');
          $this->load->view('bs/videopage/sidebar');
          $this->load->view('bs/videopage/content',$data);
           $this->load->view('bs/frontpage/footer');
        
    }
    
    public function manage(){
        $this->grocery_crud->set_table('dreamon_videos');
        $this->grocery_crud->set_relation('topic_id', 'dreamon_vidtopics', 'topic_header');
        $this->grocery_crud->set_relation_n_n('tags','dreamon_vtags','dreamon_vidtags','video_id','tag_id','tag_name');
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }
    
     function _example_output($output = null) {
          $this->load->view('videopage/include');
           $this->load->view('header/main_header');
        $this->load->view('crud_template.php', $output);
        $this->load->view('footer/footer');
    }
   
}
