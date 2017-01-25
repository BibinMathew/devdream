<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Currhome
 *
 * @author bibmathe
 */
class CurrentAffairsHome extends CI_Controller {

    //put your code here




    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model("currart/curr_art_model");
        $this->load->library('grocery_CRUD');
        $this->load->library("pagination");
            include APPPATH .'util/authUtil.php' ;
        //$this->load->library("image_lib");
        
    }

    function showfulltext($value, $row) {

        $string = strip_tags($row->currentaff_text);
        if (strlen($string) > 500) {

            // truncate string
            $string = substr($string, 0, 500);
        }
        return $value = wordwrap($string, 50, "<br>", true);
    }

    public function viewarticle($articleId) {
        $data['results'] = $this->curr_art_model->getArticle($articleId);
        $this->load->view('currentaffairs/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('currentaffairs/viewArticle', $data);
        $this->load->view('footer/footer');
    }

    public function test() {
        $this->curr_art_model->getYesterdayAndToday();
    }

    public function manage() {

        try {

            $this->grocery_crud->set_table('dreamon_currentaffairs');
            $this->grocery_crud->set_relation('caauthor_id', 'dreamon_authors', 'author_name');
            $this->grocery_crud->set_relation('topic_id', 'dreamon_currentaffairstopic', 'catopic_name');
            $this->grocery_crud->set_relation_n_n('tags', 'dreamon_currentaffairstag', 'dreamon_vidtags', 'article_id', 'tag_id', 'tag_name');
            $this->grocery_crud->set_field_upload('imageurl', 'assets/uploads/files');
            $this->grocery_crud->callback_column('currentaff_text', array($this, 'showfulltext'));
            $this->grocery_crud->callback_column('Link to Article', array($this, 'showLink'));
            //    $this->grocery_crud->set_field_upload('imageurl','assets/uploads/files'); 
            $this->grocery_crud->callback_after_upload(array($this, 'example_callback_after_upload'));
            $this->grocery_crud->columns(array('currentaff_header', 'currentaff_text', 'topic_id', 'year', 'currentaff_date', 'Link to Article'));
            $output = $this->grocery_crud->render();
            // print_r($output);
            $this->_example_output($output);
        } catch (Exception $e) {
            echo $e->getMessage();
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function showLink($value, $row) {
        $id = $row->currentaff_id;
        return "<a href='http://www.idreamias.com/currentaff/Currhome/viewarticle/$id' target='_blank'>View Article In Page</a>";
    }

    function _example_output($output = null) {
        $this->load->view('currentaffairs/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('crud_template.php', $output);
    }

    function example_callback_after_upload($uploader_response, $field_info, $files_to_upload) {
        try {
//
//Is only one file uploaded so it ok to use it with $uploader_response[0].
            $file_uploaded = $field_info->upload_path . '/' . $uploader_response[0]->name;
            $file_thumb = $field_info->upload_path . '/' . $uploader_response[0]->name . "_thump.jpg";

            $this->image_moo->load($file_uploaded)->resize(200, 150)->save($file_thumb, true);
        } catch (Exception $e) {

            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

        return true;
    }

    public function displayArticle($article_id) {
        $this->curr_art_model->getCurrentAffairs($article_id);
    }

    public function index($page = 0) {
        $config = array();
        $config["base_url"] = base_url() . "currentaff/Currhome/index/";
        $today = date("Y-m-d");
        $config["total_rows"] = $this->curr_art_model->main_record_count();
        $config["per_page"] = 2;
        $config["uri_segment"] = 4;
        $config["full_tag_open"] = '<ul class="uk-pagination">';
        $config["full_tag_close"] = '<ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="uk-active">';
        $config['cur_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="uk-pagination-previous">';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['next_tag_open'] = '<li class="uk-pagination-next">';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $today = date("Y-m-d", strtotime("-$page days"));
        $data["firstresults"] = $this->curr_art_model->fetch_cafordate($today);

        $reduceddate = -1 - $page;
        $yesterday = date("Y-m-d", strtotime("$reduceddate days"));

        $data["secondresults"] = $this->curr_art_model->fetch_cafordate($yesterday);

        $data["firstlinks"] = $this->pagination->create_links();

        
         $this->showHeader('currentaffairs/include');
        $this->load->view('bs/videopage/sidebar');
         $this->load->view('bs/currentaffairs/content',$data);
       /* $this->load->view('currentaffairs/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('currentaffairs/sidebar');
        $this->load->view("currentaffairs/currentaffaircontent", $data);
        $this->load->view('footer/footer');*/
    }

    
       public function showHeader($individual){
        $auth = new authUtil();
        $data['authUrl'] = $auth->getGoogleUrl();
        $data['fauthUrl']= $auth->getFaceBookUrl();
        
        $this->load->view('bs/include.php');
        $this->load->view($individual);
        $this->load->view('bs/nav.php',$data);
    }
    public function getCurrentAffairsByTopic($topic_id = -1) {
        $config = array();
        $config["base_url"] = base_url() . "currentaff/Currhome/topic/" . $topic_id;
        $config["total_rows"] = $this->curr_art_model->topic_record_count($topic_id);
        $config["per_page"] = 4;
        $config["uri_segment"] = 4;
        $config["full_tag_open"] = '<ul class="uk-pagination">';
        $config["full_tag_close"] = '<ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="uk-active">';
        $config['cur_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="uk-pagination-previous">';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['next_tag_open'] = '<li class="uk-pagination-next">';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;


        $data["firstresults"] = $this->curr_art_model->fetch_cafortopiclimit($config["per_page"], $page, $topic_id);
        $data["firstlinks"] = $this->pagination->create_links();

        //echo $data["links"];
        $this->load->view('currentaffairs/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('currentaffairs/sidebar');
        $this->load->view("currentaffairs/filteredCurrentAffairs", $data);
        $this->load->view('footer/footer');
    }

    public function daterange($date = 0) {

        $config = array();
        $config["base_url"] = base_url() . "currentaff/Currhome/daterange/" . $date;
        $config["total_rows"] = $this->curr_art_model->date_record_count($date);
        $config["per_page"] = 4;
        $config["uri_segment"] = 4;
        $config["full_tag_open"] = '<ul class="uk-pagination">';
        $config["full_tag_close"] = '<ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="uk-active">';
        $config['cur_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="uk-pagination-previous">';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['next_tag_open'] = '<li class="uk-pagination-next">';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;


        $data["firstresults"] = $this->curr_art_model->fetch_cafordatelimit($config["per_page"], $page, $date);
        $data["firstlinks"] = $this->pagination->create_links();

        //echo $data["links"];
        $this->load->view('currentaffairs/include');
        $this->load->view('header/main_header');
         $this->load->view('navigation/navigation');
        $this->load->view('currentaffairs/sidebar');
        $this->load->view("currentaffairs/filteredCurrentAffairs", $data);
        $this->load->view('footer/footer');
    }

}
