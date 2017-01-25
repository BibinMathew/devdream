<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThoughtModel
 *
 * @author bibmathe
 */
class Thought_model extends CI_Model {
    
    
     public function __construct() {
        parent::__construct();
        $this->load->database();
     }
    
     public function fetchThoughtofDay($date) {
        //$this->db->limit($limit, $start);
        
         $this->db->where("tod_date = '$date'");
         $this->db->select(" * , (select author_name from dreamon_authors where author_id= tod_author_id) as author");
         $query = $this->db->get("dreamon_tod");
      

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
    //put your code here
}
