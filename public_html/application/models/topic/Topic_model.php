<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of topic_model
 *
 * @author bibmathe
 */
class Topic_model extends CI_Model {
    //put your code here
    
      
     public function __construct() {
        parent::__construct();

        $this->load->database();
     }
     
      public function tree_all() {
          $result = $this->db->query("SELECT topic_id as id, topic_header as text, topic_parenttopicid FROM dreamon_vidtopics ")->result_array();
          foreach ($result as $row) {
              $data[] = $row;
              } return $data;
              }
    public function topic_description($topic_id) {
          $result = $this->db->query("SELECT  topic_header  FROM dreamon_vidtopics where topic_id =".$topic_id)->result_array();
          foreach ($result as $row) {
              $data[] = $row;
              } return $data;
              }          
}
