<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchResults
 *
 * @author bibmathe
 */
class SearchResults extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
         $this->load->helper('form');
        $this->load->model('search/Search_model');
         $this->load->library('session');
    }
    
    public function filterArticles($article){
        foreach ($article as $row) {
         
           $string = strip_tags($row->article_description);
           if (strlen($string) > 500) {
            $stringCut = substr($string, 0, 500);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href='. base_url().'/article/Articlehome/showArticle/'.$row->article_id.'">Read More</a>'; 
            $row->article_description= $string;
              }
          $src = base_url() . 'assets/uploads/files/' . $row->image.'_thump.jpg';
          if (@getimagesize($src)) {
          $row->image = base_url() . 'assets/uploads/files/' . $row->image.'_thump.jpg';
           } else {
           $row->image = base_url() . 'images/frontpage/articledefault.jpg';
              }
            
        }
        return $article;
    }

    public function Search($SearchString = '') {
        
        $videos = $this->Search_model->getVideos($SearchString);
        $article =  $this->Search_model->getArticles($SearchString);
        $currentA = $this->Search_model->getCurrentAffairs($SearchString);
        $articles = $this->filterArticles($article);
        $currentAffairs = $this->filterArticles($currentA);
        $array = array_merge($videos,$articles,$currentAffairs);
        $data['articles'] =$array; 
        $data['type'] = 'N';
         $this->session->set_userdata('searchVideos',$videos);
          $this->session->set_userdata('searchArticles',$articles);
            $this->session->set_userdata('searchCA',$currentAffairs);
        
        $this->load->view('search/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');

        $this->load->view('search/search_results',$data);
        $this->load->view('footer/footer');
    }
    
    
    public function getAllResults(){
          $searchString = $this->input->post('search');
          $this->Search($searchString);
    }
    public function allResults(){
         $videos =  $this->session->userdata('searchVideos');
          $articles =  $this->session->userdata('searchArticles');
           $ca =  $this->session->userdata('searchCA');
           $array = array_merge($videos,$articles,$ca);
            $data['articles'] =$array; 
        $data['type'] = 'N'; $this->load->view('search/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');

        $this->load->view('search/search_results',$data);
        $this->load->view('footer/footer');
    }
      public function Videos() {
        
         $videos =  $this->session->userdata('searchVideos');
        $data['articles'] =$videos; 
        $data['type'] = 'V';
        $this->load->view('search/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');

        $this->load->view('search/search_results',$data);
        $this->load->view('footer/footer');
    }
    
     public function CurrentAffairs() {
        
         $videos =  $this->session->userdata('searchCA');
        $data['articles'] =$videos; 
        $data['type'] = 'V';
        $this->load->view('search/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');

        $this->load->view('search/search_results',$data);
        $this->load->view('footer/footer');
    }
    
     public function Articles() {
        
         $articles =  $this->session->userdata('searchArticles');
        $data['articles'] =$articles; 
        $data['type'] = 'A';
        $this->load->view('search/include');
        $this->load->view('header/main_header');
        $this->load->view('navigation/navigation');

        $this->load->view('search/search_results',$data);
        $this->load->view('footer/footer');
    }


}
