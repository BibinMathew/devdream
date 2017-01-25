<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Search_model extends CI_Model {
      function __construct()
    {
        // Call the Model constructor
       parent::__construct();
       $this->load->database();
      
    }
    
   function getVideos ($Search=''){
     $SearchString =  $this->db->escape_like_str($Search);
     $str = "Select video_id as article_id , video_header as article_header ,video_description as article_description, URL as URL, DATE(created_on) as article_date , 'V' as article_type"
                . " from dreamon_videos where video_header like  '%".$SearchString."%' or video_description like  '%".$SearchString."%' ";
        $query = $this->db->query($str);
       return $query->result();
}

function getArticles($Search=''){
     $SearchString =  $this->db->escape_like_str($Search);
      $str = "Select article_id as article_id , article_heading as article_header ,article_content as article_description ,imageurl as image , DATE(article_createdon) as article_date , 'A' as article_type"
                . " from dreamon_articles where article_heading like  '%".$SearchString."%' or article_content like  '%".$SearchString."%' ";
        $query = $this->db->query($str);
       return $query->result();
}
        

function getCurrentAffairs($Search=''){
   $Search = html_entity_decode($Search);
     $SearchString =  $this->db->escape_like_str($Search);
      $str = "Select currentaff_id as article_id , currentaff_header  as article_header ,currentaff_text as article_description ,imageurl as image , DATE(currentaff_date) as article_date , 'C' as article_type"
                . " from dreamon_currentaffairs where currentaff_header like  '%".$SearchString."%' or currentaff_text like  '%".$SearchString."%' ";
        $query = $this->db->query($str);
       return $query->result();
}
     
}
