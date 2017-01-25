<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Article_model
 *
 * @author bibmathe
 */
class Article_model  extends CI_Model{
    //put your code here
    
       public function main_record_count() {
         return $this->db->count_all('dreamon_articles');
    }

    
     public function fetch_articles($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("dreamon_articles");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   
   public function getRelatedArticles($articleId){
        $topic_id = -1;
          
          $this->db->select('topic_id');
          $this->db->where('article_id',$articleId);
          
          $topicquery = $this->db->get('dreamon_articles');
           if($this->db->count_all_results() == 1){
              $row = $topicquery->result()[0];
              $topic_id = $row->topic_id;
              
           }
           
          $this->db->select('*');
          $this->db->where('topic_id',$topic_id);
          $this->db->order_by('article_createdon',"desc");
          $this->db->limit(4);
          $samevideos = $this->db->get('dreamon_articles');
          if($this->db->count_all_results() > 0){
              return $samevideos->result_array();
           }else{
             return  $this->getArticlesByTopic(-1);
           }
   }
   
   public function getArticle($article_id){
       $sql = "select * ,  ( select author_name from dreamon_authors where author_id = author_id) as authorname from dreamon_articles where article_id='".$article_id."'";
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
   
    
       public function getTopArticles(){
         $sql = " select topic_id,topic_header from dreamon_vidtopics where topic_parenttopicid is null "; 
        $result = $this->db->query($sql);
       $return = Array();
        foreach ($result->result_array() as $row) {
            
             $topic_id = $row['topic_id'];
             $innersql =  "SELECT * FROM dreamon_articles where topic_id = '".$topic_id ."' order by article_createdon desc Limit 8";
             $result = $this->db->query($innersql);
             $results = $result->result_array();
            
               if(!empty($results)){
                   $return[$row['topic_header']]=$results;
               }
              
        }return $return;
     }
    
    
    public function getArticlesByTopic($topic_id) {


        if ($topic_id == -1) {

            $sql = "SELECT * FROM dreamon_articles order by article_createdon desc Limit 8";
        } else {
            $sql = "SELECT article.article_id, article.article_heading ,article.article_content, article.imageurl ,article.article_createdon ,topics.topic_header topic_name FROM dreamon_articles article ,dreamon_vidtopics topics  where article.topic_id = " . $topic_id . "  and article.topic_id = topics.topic_id order by article_createdon desc Limit 8";
        }
        
        return $this->getResults($sql);
        
    }
    public function getArticles($topic_id) {


        if ($topic_id == -1) {

            $sql = "SELECT * FROM dreamon_articles order by article_createdon desc Limit 8";
        } /*else {
            $sql = "SELECT * FROM dreamon_currentaffairs  where topic_id = " . $topic_id . " order by currentaff_date desc Limit 8";
        }*/
        
      
        return $this->getResults($sql);
        
    }
}
