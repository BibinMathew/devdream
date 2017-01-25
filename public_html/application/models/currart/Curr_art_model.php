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
class Curr_art_model extends CI_Model {
    //put your code here
    
     public function __construct() {
        parent::__construct();
        $this->load->database();
     }
     
      public function main_record_count() {
         $result = $this->db->query("select CEILING(count(distinct(currentaff_date))/2) as days_count from dreamon_currentaffairs ");
         $results = $result->result();
         $row = $results[0];    
         return $row->days_count;
    }

    
    public function topic_record_count($topic_id){
       
         return $this->db->count_all("dreamon_currentaffairs where topic_id ='".$topic_id."'");
    }
    
    public function date_record_count($date){
       
         return $this->db->count_all("dreamon_currentaffairs where currentaff_date ='".$date."'");
    }
    
    public function getCurrentAffairsByTopic($topic_id) {


        if ($topic_id == -1) {

            $sql = "SELECT * FROM dreamon_currentaffairs order by currentaff_date desc Limit 8";
        } else {
            $sql = "SELECT * FROM dreamon_currentaffairs  where topic_id = " . $topic_id . " order by currentaff_date desc Limit 8";
        }
        
      
        return $this->getResults($sql);
        
    }
    
     
    
    
    
    public function getYesterdayAndToday(){
        $sql = "select * from dreamon_currentaffairs where currentaff_date = subdate(current_date, 1) or currentaff_date=current_date";
        print_r($this->getResults($sql));
    }
    public function fetch_currentAffairs($limit, $start) {
        $this->db->limit($limit, $start);
          $this->db->where(' currentaff_date = subdate(current_date, 1)');
        $query = $this->db->get("dreamon_currentaffairs");
      

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   public function getArticle($currentaff_id){
       $sql = "select * ,  ( select author_name from dreamon_authors where author_id = caauthor_id) as authorname from dreamon_currentaffairs where currentaff_id='".$currentaff_id."'";
       return $this->getResults($sql);
   }
    public function fetch_cafordate($date) {
        //$this->db->limit($limit, $start);
        
         $this->db->where("currentaff_date = '$date'");
         $this->db->select(" * , (select author_name from dreamon_authors where author_id= caauthor_id) as author");
         $query = $this->db->get("dreamon_currentaffairs");
      

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
    public function fetch_cafortopiclimit($limit,$start,$topic_id) {
         
        $this->db->limit($limit, $start);
         $this->db->where("topic_id = '$topic_id'");
          $this->db->select(" * , (select author_name from dreamon_authors where author_id= caauthor_id) as author");
         $this->db->order_by("currentaff_date","desc");
         $query = $this->db->get("dreamon_currentaffairs");
      

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
     public function fetch_cafordatelimit($limit,$start,$date) {
        //$this->db->limit($limit, $start);
        
         $this->db->where("currentaff_date = '$date'");
         $this->db->select(" * , (select author_name from dreamon_authors where author_id= caauthor_id) as author");
         $query = $this->db->get("dreamon_currentaffairs");
      

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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
