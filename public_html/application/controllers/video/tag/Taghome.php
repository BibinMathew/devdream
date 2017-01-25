<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Taghome
 *
 * @author bibmathe
 */
class Taghome extends CI_Controller{
    //put your code here
    
      public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
    }
    
    
    public function manage() {

        $this->grocery_crud->set_table('dreamon_vidtags');
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null) {
         $this->load->view('videopage/header');
        $this->load->view('crud_template.php', $output);
    }
}
