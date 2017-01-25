<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Topichome
 *
 * @author bibmathe
 */
class Topichome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
         $this->load->model('topic/topic_model');
        $this->load->library('grocery_CRUD');
    }

    //put your code here

    public function manage() {

        $this->grocery_crud->set_table('dreamon_vidtopics');
        $this->grocery_crud->set_relation('topic_parenttopicid', 'dreamon_vidtopics', 'topic_header');
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null) {
         $this->load->view('videopage/header');
        $this->load->view('crud_template.php', $output);
        $this->load->view('footer/footer');
    }
    
    public function index(){
          $this->load->view('templates/default/header');
          $this->load->view('templates/default/sidebar');
         
          $this->load->view('templates/default/content',$data);
          $this->load->view('templates/default/footer');
          $this->load->view('footer/footer');
    }

     protected function outputJSON($json) 
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header('Content-Type: application/json');
        print $json;
        die();      
    }   
   
    
    public function getTopicDescription ($topic_id=0){
        $result = $this->topic_model->topic_description($topic_id);
        if (empty($result)) {
        $arr_data = array(
            'success' => false, 
            'content' => 'We could not find the details for the selected album.'
        );
    } else {
         ob_start();
         $partial_view_filename = $this->getPartialFilename('videoload');
        include $partial_view_filename;
        $content = ob_get_clean();
        $arr_data = array('success' => true, 'content' => $content);
        }
         echo $this->outputJSON(json_encode($result));
    }
    function getChildren() {
        $result = $this->topic_model->tree_all();
        $itemsByReference = array(); // Build array of item references: 
        foreach ($result as $key => &$item) {
            $itemsByReference[$item['id']] = &$item;
            // Children array: 
            $itemsByReference[$item['id']]['children'] = array();
            
            // Empty data class (so that json_encode adds "data: {}" ) 
            $itemsByReference[$item['id']]['data'] = new StdClass();
        }
        // Set items as children of the relevant parent item. 
        foreach ($result as $key => &$item){
            
            if ($item['topic_parenttopicid'] && isset($itemsByReference[$item['topic_parenttopicid']]))
                $itemsByReference [$item['topic_parenttopicid']]['children'][] = &$item;
        }
        // Remove items that were added to parents elsewhere: 
        foreach ($result as $key => &$item) {
            if ($item['topic_parenttopicid'] && isset($itemsByReference[$item['topic_parenttopicid']]))
                unset($result[$key]);
        }
        foreach ($result as $row) {
            $data[] = $row;
        } // Encode:
        echo json_encode($data);
    }

}
