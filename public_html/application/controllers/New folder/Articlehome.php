<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Articlehome
 *
 * @author bibmathe
 */
class Articlehome extends  CI_Controller {
    //put your code here
    
         public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
       
         $this->load->library('grocery_CRUD');
    }
    
      public function manage(){
        $this->grocery_crud->set_table('dreamon_articles');
        $this->grocery_crud->set_relation('author_id', 'dreamon_authors', 'author_name');
      //  $this->grocery_crud->set_relation_n_n('tags','dreamon_vtags','dreamon_vidtags','video_id','tag_id','tag_name');
        $this->grocery_crud->set_field_upload('imageurl','assets/uploads/files'); 
        $output = $this->grocery_crud->render();
        //print_r($output);
       $this->_example_output($output);
    }
    
    function _example_output($output = null) {
          $this->load->view('videopage/header');
        $this->load->view('crud_template.php', $output);
    }
    
    
    
}
