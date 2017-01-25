<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tag_model
 *
 * @author bibmathe
 */
class Tag_model extends CI_Model {
    //put your code here
    
     public function __construct() {
        parent::__construct();
        $this->load->database();
     }
      public function getTagsForVideo($video_id) {
          $result = $this->db->query("SELECT  tag_name  FROM dreamon_vidtags where tag_id in ( select tag_id from dreamon_vtags where video_id =".$video_id.")")->result_array();
          $data=Array();
          foreach ($result as $row) {
              $data[] = $row;
              }
              return $data;
              }
              
              
          
}
