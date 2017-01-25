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
        include APPPATH .'util/authUtil.php' ;
        $this->load->library("pagination");
         $this->load->model("articles/article_model");
         $this->load->library('grocery_CRUD');
    }
    
      public function manage(){
        $this->grocery_crud->set_table('dreamon_articles');
        $this->grocery_crud->set_relation('author_id', 'dreamon_authors', 'author_name');
        $this->grocery_crud->set_relation('topic_id', 'dreamon_vidtopics', 'topic_header');
      //  $this->grocery_crud->set_relation_n_n('tags','dreamon_vtags','dreamon_vidtags','video_id','tag_id','tag_name');
        $this->grocery_crud->set_field_upload('imageurl','assets/uploads/files');
         $this->grocery_crud->callback_after_upload(array($this, 'example_callback_after_upload'));
        $output = $this->grocery_crud->render();
        //print_r($output);
       $this->_example_output($output);
    }
    
    public function getArticlebyTopic ($topic_id=-1){
        $result = $this->article_model->getArticlesByTopic($topic_id);
        $articles = $this->filterArticles($result,false);
        echo json_encode($articles);
    }
    
    
     public function allTopArticles (){
        $result = $this->article_model->getTopArticles();
         foreach($result as $key=>&$value){
           
           $value=$this->filterArticles($value,false);
        }
       // return $value;
      return  $result;
    }
    function _example_output($output = null) {
        $this->load->view('article/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('crud_template.php', $output);
    }
    
    function example_callback_after_upload($uploader_response, $field_info, $files_to_upload) {
        $this->load->library('image_moo');

//Is only one file uploaded so it ok to use it with $uploader_response[0].
        $file_uploaded = $field_info->upload_path . '/' . $uploader_response[0]->name;
        $file_thumb = $field_info->upload_path . '/' . $uploader_response[0]->name . "_thump.jpg";

        $this->image_moo->load($file_uploaded)->resize(240, 150)->save($file_thumb, true);

        return true;
    }
    
    public function  index(){
        $config = array();
        $config["base_url"] = base_url() . "article/Articlehome";
        $config["total_rows"] = $this->article_model->main_record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
        
          $this->pagination->initialize($config);
          $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
          
          $data["results"] = $this->article_model->
            fetch_articles($config["per_page"], $page);
         $data["links"] = $this->pagination->create_links();
        
         
         $data['latest']= $this->getLatest();
         $data['top'] = $this->allTopArticles();
         $this->showHeader('article/include');
        $this->load->view('bs/videopage/sidebar');
        $this->load->view('bs/articlepage/content',$data);
        $this->load->view('bs/frontpage/footer');
      /* $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('article/articleindex', $data);*/
    }
    
    public function filterArticles($article,$isSingle){
        foreach ($article as &$row) {
         
            if(!$isSingle){
           $string = strip_tags($row['article_content']);
          
           
           if (strlen($string) > 200) {
            $stringCut = substr($string, 0, 200);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a  class="btn btn-primary" role="button" href='. base_url().'article/Articlehome/showArticle/'.$row['article_id'].'">Read More</a>'; 
            $row['article_content']= $string;
              }
           
           
          $src = base_url() . 'assets/uploads/files/' .  $row['imageurl'].'_thump.jpg';
          if (@getimagesize($src)) {
          $row['imageurl'] = base_url() . 'assets/uploads/files/' .  $row['imageurl'].'_thump.jpg';
           } else {
           $row['imageurl'] = base_url() . 'images/frontpage/articledefault.jpg';
              }
            }else{
                 $row['imageurl'] =  base_url() . 'assets/uploads/files/' .  $row['imageurl'];
            }
        }
        return $article;
       
    }
    
    
    
      public function getLatest(){
        //latest
         $results = $this->article_model->getArticlesByTopic(-1);
         return $this->filterArticles($results,false);
         
    }
     public function getRelatedArticles ($articleId){
       return $this->article_model->getRelatedArticles($articleId);
    }
    
    public function showArticle($article_id=0){
        $results = $this->article_model->getArticle($article_id);
        $article=$this->filterArticles($results,true);
        $data['result'] = $article[0];
        $data['related'] = $this->getRelatedArticles($article_id);
          $this->showHeader('article/include');
          $this->load->view('bs/articlepage/articlesingle',$data);
          $this->load->view('bs/frontpage/footer');
          /*
        $this->load->view('article/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');
        $this->load->view('article/view_article',$data);
           * */
           
    }
    
      public function showHeader($individual){
        $auth = new authUtil();
        $data['authUrl'] = $auth->getGoogleUrl();
        $data['fauthUrl']= $auth->getFaceBookUrl();
        
        $this->load->view('bs/include.php');
        $this->load->view($individual);
        $this->load->view('bs/nav.php',$data);
    }
}
