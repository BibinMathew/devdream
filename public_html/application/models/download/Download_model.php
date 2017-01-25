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
class Download_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getDownloads() {
       $sql = "SELECT download_name as name , download_url as url FROM dreamon_downloads order by date desc Limit 30";
       return $this->getResults($sql);
        
    }
    
    public function getDownloadsForTopic($topic_id){
    
      if ($topic_id == -1) {

            $sql = "SELECT download_name as name , download_url as url FROM dreamon_downloads order by date desc Limit 30";
        } else {
            $sql = "SELECT download_name as name , download_url as url FROM dreamon_downloads where topic_id = " . $topic_id . " order by date desc Limit 3";
        }
        
        return $this->getResults($sql);
        
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
   
}
