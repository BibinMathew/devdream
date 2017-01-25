<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DownloadHome
 *
 * @author bibmathe
 */
class DownloadHome extends CI_Controller {

    //put your code here


    var $downloadPath = 'assets/uploads/files/downloads/';

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->model('download/download_model');
    }

    public function index() {
        
        $results = $this->download_model->getDownloadsForTopic(-1);
        $data['results'] = $results;
        $this->load->view('download/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('videopage/sidebar');
        $this->load->view('download/download-content', $data);
        $this->load->view('footer/footer');
    }

    public function getDownloadsForTopicId($topic_id) {
        $result = $this->download_model->getDownloadsForTopic($topic_id);
        echo json_encode($result);
    }

    public function manage() {
        $this->grocery_crud->set_table('dreamon_downloads');
        $this->grocery_crud->set_field_upload('download_url', $this->downloadPath);
        $this->grocery_crud->set_relation('topic_id', 'dreamon_vidtopics', 'topic_header');

        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null) {
         $this->load->view('download/include');
        $this->load->view('header/main_header');

        $this->load->view('crud_template.php', $output);
    }

    function download() {

        $this->load->helper('download');
        $data = file_get_contents(base_url() . $this->downloadPath . $this->uri->segment(4)); // Read the file's contents
        $name = $this->uri->segment(4);
        force_download($name, $data);
    }

}
