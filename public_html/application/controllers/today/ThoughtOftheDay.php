<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThoughtOftheDay
 *
 * @author bibmathe
 */
class ThoughtOftheDay extends  CI_Controller {
    //put your code here
    
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
         $this->load->library('grocery_CRUD');
        $this->load->model('thought/Thought_model');
    }
    
    
    public function manage(){
        $this->grocery_crud->set_table('dreamon_tod');
        $this->grocery_crud->set_relation('tod_author_id', 'dreamon_authors', 'author_name');
         $output = $this->grocery_crud->render();
        //print_r($output);
       $this->_example_output($output);
    }
    
       function _example_output($output = null) {
        $this->load->view('article/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('crud_template.php', $output);
    }
    
    
    public function getThoughtOfTheDay(){
        $today = date("Y-m-d");
        $thought = $this->ThoughtModel->fetchThoughtofDay($today);
       
        
    }
    
}
