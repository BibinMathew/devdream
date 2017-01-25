<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of quiz_model
 *
 * @author bibmathe
 */
class quiz_model extends CI_Model{
    //put your code here
    
 public function fetch_quizfortoday($date) {
        //$this->db->limit($limit, $start);
        
         $this->db->where("date = '$date'");
         $this->db->select(" imageurl as image ,Question as q, Explanation as correct, WrongAnswer as incorrect , 'A' as a,dailyquiz_id as question_id");
         $query = $this->db->get("dreamon_dailyquiz");
      

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
             
                $data[] = $row;
            }
            return $data;
        }
        return Array();
   }
   
   
   public function getAnswerJson($question_id=0){
       
       $this->db->select(" answer_text as option , IF(TrueFalse='N','false','true') as correct");
       $this->db->where("question_id='".$question_id."'");
       $query = $this->db->get('dreamon_dailyquizans');
       
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
             if($row->correct=='true')$row->correct = true;
                      else $row->correct=false;
                $data[] = $row;
            }
            return $data;
        }
          return Array();
   }
}
