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
class topic_model extends CI_Model{
    //put your code here
     
     public function __construct() {
        parent::__construct();

        $this->load->database();
     }
     
       public function tree_all() {
          $result = $this->db->query("SELECT catopic_id as id, catopic_name as text, catopic_parentid as topic_parenttopicid FROM dreamon_currentaffairstopic ")->result_array();
          foreach ($result as $row) {
              $data[] = $row;
              } return $data;
              }
       public function topic_description($topic_id) {
          $result = $this->db->query("SELECT  catopic_name  FROM dreamon_currentaffairstopic where topic_id =".$topic_id)->result_array();
          foreach ($result as $row) {
              $data[] = $row;
              } return $data;
              }  
}
