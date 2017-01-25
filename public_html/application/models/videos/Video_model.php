<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of video_model
 *
 * @author bibmathe
 */
class Video_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getVideoByTopic($topic_id) {


        if ($topic_id == -1) {

            $sql = "SELECT * FROM dreamon_videos order by created_on desc Limit 8";
        } else {
            $sql = "SELECT video.video_id, video.video_header ,video.video_description, video.url ,video.created_on ,topics.topic_header topic_name FROM dreamon_videos video ,dreamon_vidtopics topics  where video.topic_id = " . $topic_id . "  and video.topic_id = topics.topic_id order by created_on desc Limit 8";
        }
        
        return $this->getResults($sql);
        
    }
    public function getVideosForKeyword($keyword){
        $sql = "SELECT * FROM dreamon_videos where video_description like '%".$keyword."%' OR video_header like '%".$keyword."%' ";
        return $this->getResults($sql);
    }
    public function getVideosForTag($tag_id) {
        $sql = "SELECT * FROM dreamon_videos where video_id in (select video_id from dreamon_vtags where tag_id  = " . $tag_id . " )order by created_on desc Limit 3";
       return $this->getResults($sql);
              }
            
              
      public function uplike($videoId){
          
          $currentlike =0;
          $this->db->select('likecount');
          $this->db->where('video_id',$videoId);
          $query = $this->db->get('dreamon_videos');
          if($this->db->count_all_results() == 1){
              $row = $query->result()[0];
              $currentlike = $row->likecount;
              $currentlike = $currentlike+1;
          }
         
           $data = array('likecount' => $currentlike);
           $this->db->where('video_id', $videoId);
           $this->db->from('dreamon_videos');
           $this->db->update('dreamon_videos', $data);
          return $currentlike;   
      }
      
      
        public function downLike($videoId){
          
          $currentlike =0;
          $this->db->select('dislikecount');
          $this->db->where('video_id',$videoId);
          $query = $this->db->get('dreamon_videos');
          if($this->db->count_all_results() == 1){
              $row = $query->result()[0];
              $currentlike = $row->dislikecount;
              $currentlike = $currentlike+1;
          }
         
           $data = array('dislikecount' => $currentlike);
           $this->db->where('video_id', $videoId);
           $this->db->from('dreamon_videos');
           $this->db->update('dreamon_videos', $data);
           return $currentlike;
             
      }
              
      
      public function upviewCount($videoId){
           $viewcount =0;
          $this->db->select('viewcount');
          $this->db->where('video_id',$videoId);
          $query = $this->db->get('dreamon_videos');
          if($this->db->count_all_results() == 1){
              $row = $query->result()[0];
              $viewcount = $row->viewcount;
              $viewcount = $viewcount+1;
          }
         
           $data = array('viewcount' => $viewcount);
           $this->db->where('video_id', $videoId);
           $this->db->from('dreamon_videos');
           $this->db->update('dreamon_videos', $data);
      }
     public function getTopVideos(){
         $sql = " select topic_id,topic_header from dreamon_vidtopics where topic_parenttopicid is null "; 
        $result = $this->db->query($sql);
       $return = Array();
        foreach ($result->result_array() as $row) {
            
             $topic_id = $row['topic_id'];
             $innersql =  "SELECT * FROM dreamon_videos where topic_id = '".$topic_id ."' order by created_on desc Limit 8";
             $result = $this->db->query($innersql);
             $results = $result->result();
               if(!empty($results)){
                   $return[$row['topic_header']]=$results;
               }
              
        }return $return;
     }
    
    
    public function getResults($sql){
        $result = $this->db->query($sql);
        $results = $result->result();
        if(empty($results)) return Array();
        
        foreach ($result->result_array() as $row) {
            
            $data[] = $row;
        }
        return $data;
    }
    
    public function getMostViewedVideos(){
          $this->db->select('*');
          $this->db->order_by('viewcount desc, created_on desc');
          $this->db->limit(6);
          $query = $this->db->get('dreamon_videos');
          return $query->result_array();
           
          
    }
    
    public function getRelatedVideos($video_id){
          $topic_id = -1;
          
          $this->db->select('topic_id');
          $this->db->where('video_id',$video_id);
          
          $topicquery = $this->db->get('dreamon_videos');
           if($this->db->count_all_results() == 1){
              $row = $topicquery->result()[0];
              $topic_id = $row->topic_id;
              
           }
           
          $this->db->select('*');
          $this->db->where('topic_id',$topic_id);
          $this->db->order_by('created_on',"desc");
          $this->db->limit(4);
          $samevideos = $this->db->get('dreamon_videos');
          if($this->db->count_all_results() > 0){
              return $samevideos->result_array();
           }else{
             return  $this->getVideoByTopic(-1);
           }
           
           
    }
     public function getVideo($video_id) {

         $this->upviewCount($video_id);
        if ($video_id == -1) {

            $sql = "SELECT * FROM dreamon_videos order by created_on desc Limit 3";
        } else {
            $sql = "SELECT * FROM dreamon_videos where video_id = " . $video_id . " order by created_on desc Limit 3";
        }
        
       return $this->getResults($sql);
    }
}
