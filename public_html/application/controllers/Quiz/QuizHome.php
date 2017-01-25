<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuizHome
 *
 * @author bibmathe
 */
class QuizHome extends CI_Controller {

    //put your code here


    var $choiceOne;
    var $choiceTwo;
    var $choiceThree;
    var $choiceFour;
    var $isOneTrue;
    var $isTwoTrue;
    var $isThreeTrue;
    var $isFourTrue;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->model("quiz/quiz_model");
    }

    public function index() {

        $today = date("Y-m-d");
        echo $today;
        $results = $this->quiz_model->fetch_quizfortoday($today);
        $data['questions'] = $results;
        //   print_r($results);


        $this->load->view('Quiz/quizpage', $data);
    }

    public function manage() {

        $this->grocery_crud->set_table('dreamon_dailyquiz');
        $this->grocery_crud->set_relation('createdby', 'dreamon_authors', 'author_name');
        $this->grocery_crud->fields('dailyquiz_id', 'Question', 'imageurl', 'ChoiceOne', 'isTrueOne', 'ChoiceTwo', 'isTrueTwo', 'ChoiceThree', 'isTrueThree', 'ChoiceFour', 'isTrueFour', 'Explanation','WrongAnswer','date', 'createdby');


        $this->grocery_crud->display_as('imageurl', 'Upload Image')->display_as('ChoiceOne', 'First Choice')
                ->display_as('ChoiceOne', 'First Choice')->display_as('ChoiceTwo', 'Second Choice')
                 ->display_as('ChoiceThree', 'Third Choice')->display_as('isTrueOne', 'Is First choice answer?')
                 ->display_as('isTrueTwo', 'Is second choice answer?') ->display_as('isTrueThree', 'Is third choice answer?')
                ->display_as('isTrueFour', 'Is four choice answer?') ->display_as('createdby', 'Author');
        //add fields

         $this->grocery_crud->callback_add_field('ChoiceOne', array($this, 'choiceTextfieldOne'));
        $this->grocery_crud->callback_add_field('isTrueOne', array($this, 'isTrueAnswerOne'));
        $this->grocery_crud->callback_add_field('ChoiceTwo', array($this, 'choiceTextfieldTwo'));
        $this->grocery_crud->callback_add_field('isTrueTwo', array($this, 'isTrueAnswerTwo'));
        $this->grocery_crud->callback_add_field('ChoiceThree', array($this, 'choiceTextfieldThree'));
        $this->grocery_crud->callback_add_field('isTrueThree', array($this, 'isTrueAnswerThree'));
        $this->grocery_crud->callback_add_field('ChoiceFour', array($this, 'choiceTextfieldFour'));
        $this->grocery_crud->callback_add_field('isTrueFour', array($this, 'isTrueAnswerFour'));

        $this->grocery_crud->change_field_type('dailyquiz_id', 'invisible');
       //
 
        /* Callback
         */

        $this->grocery_crud->callback_column('ChoiceOne', array($this, 'displayChoiceOne'));
        $this->grocery_crud->callback_column('isTrueOne', array($this, 'displayRadioChoiceOne'));
        $this->grocery_crud->callback_column('ChoiceTwo', array($this, 'displayChoiceTwo'));
        $this->grocery_crud->callback_column('isTrueTwo', array($this, 'displayRadioChoiceTwo'));
        $this->grocery_crud->callback_column('ChoiceThree', array($this, 'displayChoiceThree'));
        $this->grocery_crud->callback_column('isTrueThree', array($this, 'displayRadioChoiceThree'));
        $this->grocery_crud->callback_column('ChoiceFour', array($this, 'displayChoiceFour'));
        $this->grocery_crud->callback_column('isTrueFour', array($this, 'displayRadioChoiceFour'));

        /* Edit Fields
         * 
         */


        $this->grocery_crud->callback_edit_field('ChoiceOne', array($this, 'editFieldChoiceOne'));
        $this->grocery_crud->callback_edit_field('ChoiceTwo', array($this, 'editFieldChoiceTwo'));
        $this->grocery_crud->callback_edit_field('ChoiceThree', array($this, 'editFieldChoiceThree'));
        $this->grocery_crud->callback_edit_field('ChoiceFour', array($this, 'editFieldChoiceFour'));

        $this->grocery_crud->callback_edit_field('isTrueOne', array($this, 'editRadioButtonOne'));
        $this->grocery_crud->callback_edit_field('isTrueTwo', array($this, 'editRadioButtonTwo'));
        $this->grocery_crud->callback_edit_field('isTrueThree', array($this, 'editRadioButtonThree'));
        $this->grocery_crud->callback_edit_field('isTrueFour', array($this, 'editRadioButtonFour'));


        $this->grocery_crud->callback_read_field('ChoiceOne', array($this, 'readFieldChoiceOne'));
        $this->grocery_crud->callback_read_field('ChoiceTwo', array($this, 'readFieldChoiceTwo'));
        $this->grocery_crud->callback_read_field('ChoiceThree', array($this, 'readFieldChoiceThree'));
        $this->grocery_crud->callback_read_field('ChoiceFour', array($this, 'readFieldChoiceFour'));
           
           
      $this->grocery_crud->callback_read_field('isTrueOne', array($this, 'readRadioButtonOne'));
      $this->grocery_crud->callback_read_field('isTrueTwo', array($this, 'readRadioButtonTwo'));
      $this->grocery_crud->callback_read_field('isTrueThree', array($this, 'readRadioButtonThree'));
      $this->grocery_crud->callback_read_field('isTrueFour', array($this, 'readRadioButtonFour'));
               

        $this->grocery_crud->callback_before_insert(array($this, 'beforeinsert_callback'));
        $this->grocery_crud->callback_after_insert(array($this, 'afterinsert_callback'));

        $this->grocery_crud->callback_before_update(array($this, 'beforeupdate_callback'));
        $this->grocery_crud->callback_after_update(array($this, 'afterupdate_callback'));

        $this->grocery_crud->set_field_upload('imageurl', 'assets/uploads/files/dqImage/');
        $this->grocery_crud->callback_after_upload(array($this, 'resize_dqImage'));
        $output = $this->grocery_crud->render();
        // print_r($output);
        $this->_example_output($output);
    }

    function displayChoiceOne($value, $row) {
        return $this->displayChoice($row, 1);
    }

    function displayChoiceTwo($value, $row) {
        return $this->displayChoice($row, 2);
    }

    function displayChoiceThree($value, $row) {
        return $this->displayChoice($row, 3);
    }

    function displayChoiceFour($value, $row) {
        return $this->displayChoice($row, 4);
    }

    function displayRadioChoiceOne($value, $row) {
        return $this->displayRadio($row, 1);
    }

    function displayRadioChoiceTwo($value, $row) {
        return $this->displayRadio($row, 2);
    }

    function displayRadioChoiceThree($value, $row) {
        return $this->displayRadio($row, 3);
    }

    function displayRadioChoiceFour($value, $row) {
        return $this->displayRadio($row, 4);
    }

    function displayRadio($row, $choice_num) {
        $row_id = $row->dailyquiz_id;
        $firstChoice = $this->queryDB("select TrueFalse from dreamon_dailyquizans where question_id='" . $row_id . "' and choice_num='" . $choice_num . "'");
        if (!empty($firstChoice)) {
            if ($firstChoice[0]->TrueFalse == 'Y')
                return "True";
        }
        return "False";
    }

    function displayChoice($row, $choice_num) {
        $row_id = $row->dailyquiz_id;
        $firstChoice = $this->queryDB("select answer_text from dreamon_dailyquizans where question_id='" . $row_id . "' and choice_num='" . $choice_num . "'");
        if (!empty($firstChoice))
            return wordwrap($firstChoice[0]->answer_text, 50, "<br>", true);
        else
            return "";
    }

    function queryDB($str) {
        $query = $this->db->query($str);
        $results_array = $query->result();
        return $results_array;
    }

    function editRadioButtonOne($value, $primary_key) {
        return $this->editRadioButton("One", 1, $primary_key);
    }

    function editRadioButtonTwo($value, $primary_key) {
        return $this->editRadioButton("Two", 2, $primary_key);
    }

    function editRadioButtonThree($value, $primary_key) {
        return $this->editRadioButton("Three", 3, $primary_key);
    }

    function editRadioButtonFour($value, $primary_key) {
        return $this->editRadioButton("Four", 4, $primary_key);
    }
    
    

    function editRadioButton($choice, $choice_num, $primary_key) {
        $firstChoice = $this->queryDB("select TrueFalse from dreamon_dailyquizans where question_id='" . $primary_key . "' and choice_num='" . $choice_num . "'");

        if (!empty($firstChoice)) {
            if ($firstChoice[0]->TrueFalse == 'Y') {
                $checkboxButton = '<input type="checkbox"  value="True" name="isTrueAnswer' . $choice . '" checked> True <input type="checkbox" value="false" name="isTrueAnswer' . $choice . '" > False';
                return $checkboxButton;
            }
        }
        $checkboxButton = '<input type="checkbox" value="True" name="isTrueAnswer' . $choice . '">  True <input type="checkbox"  value="false" name="isTrueAnswer' . $choice . '"checked> False';
        return $checkboxButton;
    }
    
     function readRadioButton($choice, $choice_num, $primary_key) {
        $firstChoice = $this->queryDB("select TrueFalse from dreamon_dailyquizans where question_id='" . $primary_key . "' and choice_num='" . $choice_num . "'");

        if (!empty($firstChoice)) {
            if ($firstChoice[0]->TrueFalse == 'Y') {
                $checkboxButton = '<input type="checkbox" name="isTrueAnswer' . $choice . '" checked disabled>';
                return $checkboxButton;
            }
        }
        $checkboxButton = '<input type="checkbox" name="isTrueAnswer' . $choice . '" disabled>';
        return $checkboxButton;
    }

    function readRadioButtonOne($value, $primary_key) {
        return $this->readRadioButton("One", 1, $primary_key);
    }

    function readRadioButtonTwo($value, $primary_key) {
        return $this->readRadioButton("Two", 2, $primary_key);
    }

    function readRadioButtonThree($value, $primary_key) {
        return $this->readRadioButton("Three", 3, $primary_key);
    }

    function readRadioButtonFour($value, $primary_key) {
        return $this->readRadioButton("Four", 4, $primary_key);
    }
    
    
    
    
    
    //Edit Choices 
    function editFieldChoice( $primary_key,$choice,$choice_num) {
        $firstChoice = $this->queryDB("select answer_text from dreamon_dailyquizans where question_id='" . $primary_key . "' and choice_num='".$choice_num."'");
        return '<input type="text"  value="' . $firstChoice[0]->answer_text . '" name="Choice'.$choice.'"  style="width:800px;padding:10px 5px 200px;">';
    }
    
    function editFieldChoiceOne($value, $primary_key) {
        return $this->editFieldChoice($primary_key,"One",1);
    }

    function editFieldChoiceTwo($value, $primary_key) {
        return $this->editFieldChoice($primary_key,"Two",2);
    }

    function editFieldChoiceThree($value, $primary_key) {
         return $this->editFieldChoice($primary_key,"Three",3);
         }

    function editFieldChoiceFour($value, $primary_key) {
        return $this->editFieldChoice($primary_key,"Four",4);
    }
    function readFieldChoice( $primary_key,$choice,$choice_num) {
        $firstChoice = $this->queryDB("select answer_text from dreamon_dailyquizans where question_id='" . $primary_key . "' and choice_num='".$choice_num."'");
        return '<input type="text"  value="' . $firstChoice[0]->answer_text . '" name="Choice'.$choice.'"  style="width:800px;padding:10px 5px 200px;" disabled>';
    }
    
     function readFieldChoiceOne($value, $primary_key) {
        return $this->readFieldChoice($primary_key,"One",1);
    }

    function readFieldChoiceTwo($value, $primary_key) {
        return $this->readFieldChoice($primary_key,"Two",2);
    }

    function readFieldChoiceThree($value, $primary_key) {
         return $this->readFieldChoice($primary_key,"Three",3);
         }

    function readFieldChoiceFour($value, $primary_key) {
        return $this->readFieldChoice($primary_key,"Four",4);
    }

    function _example_output($output = null) {
        $this->load->view('videopage/include');
           $this->load->view('header/main_header');
        $this->load->view('crud_template.php', $output);
        $this->load->view('footer/footer');
    }

    function insertAnswer($question, $choice, $isTrue, $choice_num) {

        $sql = "insert into dreamon_dailyquizans (question_id,answer_text,trueFalse,choice_num)values('" . $question . "','" . $choice . "','" . $isTrue . "','" . $choice_num . "')";
        $query = $this->db->query($sql);
    }

    function updateAnswer($question, $choice, $isTrue, $choice_num) {

        $sql = "update dreamon_dailyquizans set answer_text = '" . $choice . "'  , trueFalse = '" . $isTrue . "' where  question_id = '" . $question . "' and choice_num = '" . $choice_num . "'";
        $query = $this->db->query($sql);
    }

    function beforeinsert_callback($post_array) {

        if (!empty($post_array['ChoiceOne'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceOne = $post_array['ChoiceOne'];
            if ($post_array['isTrueAnswerOne'] == 'True') {
                $this->isOneTrue = 'Y';
            } else
                $this->isOneTrue = 'N';
        }
        if (!empty($post_array['ChoiceTwo'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceTwo = $post_array['ChoiceTwo'];
            if ($post_array['isTrueAnswerTwo'] == 'True') {
                $this->isTwoTrue = 'Y';
            } else
                $this->isTwoTrue = 'N';
        }
        if (!empty($post_array['ChoiceThree'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceThree = $post_array['ChoiceThree'];
            if ($post_array['isTrueAnswerThree'] == 'True') {
                $this->isThreeTrue = 'Y';
            } else
                $this->isThreeTrue = 'N';
        }
        if (!empty($post_array['ChoiceFour'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceFour = $post_array['ChoiceFour'];
            if ($post_array['isTrueAnswerFour'] == 'True') {
                $this->isFourTrue = 'Y';
            } else
                $this->isFourTrue = 'N';
        }
        unset($post_array['ChoiceOne']);
        unset($post_array['isTrueOne']);
        unset($post_array['ChoiceTwo']);
        unset($post_array['isTrueTwo']);
        unset($post_array['ChoiceThree']);
        unset($post_array['isTrueThree']);
        unset($post_array['ChoiceFour']);
        unset($post_array['isTrueFour']);


        return $post_array;
    }

    function beforeupdate_callback($post_array, $primary_key) {

        if (!empty($post_array['ChoiceOne'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceOne = $post_array['ChoiceOne'];
            if ($post_array['isTrueAnswerOne'] == 'True') {
                $this->isOneTrue = 'Y';
            } else
                $this->isOneTrue = 'N';
        }
        if (!empty($post_array['ChoiceTwo'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceTwo = $post_array['ChoiceTwo'];
            if ($post_array['isTrueAnswerTwo'] == 'True') {
                $this->isTwoTrue = 'Y';
            } else
                $this->isTwoTrue = 'N';
        }
        if (!empty($post_array['ChoiceThree'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceThree = $post_array['ChoiceThree'];
            if ($post_array['isTrueAnswerThree'] == 'True') {
                $this->isThreeTrue = 'Y';
            } else
                $this->isThreeTrue = 'N';
        }
        if (!empty($post_array['ChoiceFour'])) {
            // $this->insertAnswer($quizId,$post_array['ChoiceOne'],$post_array['isTrueOne']);
            $this->choiceFour = $post_array['ChoiceFour'];
            if ($post_array['isTrueAnswerFour'] == 'True') {
                $this->isFourTrue = 'Y';
            } else
                $this->isFourTrue = 'N';
        }
        unset($post_array['ChoiceOne']);
        unset($post_array['isTrueOne']);
        unset($post_array['ChoiceTwo']);
        unset($post_array['isTrueTwo']);
        unset($post_array['ChoiceThree']);
        unset($post_array['isTrueThree']);
        unset($post_array['ChoiceFour']);
        unset($post_array['isTrueFour']);


        return $post_array;
    }

    function afterinsert_callback($post_array, $primary_key) {
        $quizId = $primary_key;
        $this->insertAnswer($quizId, $this->choiceOne, $this->isOneTrue, 1);
        $this->insertAnswer($quizId, $this->choiceTwo, $this->isTwoTrue, 2);
        $this->insertAnswer($quizId, $this->choiceThree, $this->isThreeTrue, 3);
        $this->insertAnswer($quizId, $this->choiceFour, $this->isFourTrue, 4);
        return true;
    }

    function afterupdate_callback($post_array, $primary_key) {
        $quizId = $primary_key;
        $this->updateAnswer($quizId, $this->choiceOne, $this->isOneTrue, 1);
        $this->updateAnswer($quizId, $this->choiceTwo, $this->isTwoTrue, 2);
        $this->updateAnswer($quizId, $this->choiceThree, $this->isThreeTrue, 3);
        $this->updateAnswer($quizId, $this->choiceFour, $this->isFourTrue, 4);
        return true;
    }

    // Choice TextField 
    function choiceTextfieldOne() {
        return '<input type="textarea" style="width: 300px; height: 150px;"  value="" name="ChoiceOne">';
    }

    function choiceTextfieldTwo() {
        return '<input type="textarea" style="width: 300px; height: 150px;" value="" name="ChoiceTwo">';
    }

    function choiceTextfieldThree() {
        return '<input type="textarea" style="width: 300px; height: 150px;" value="" name="ChoiceThree">';
    }

    function choiceTextfieldFour() {
        return '<input type="textarea" style="width: 300px; height: 150px;" value="" name="ChoiceFour">';
    }

    function isTrueAnswerOne() {
        return '<input type="checkbox"   value="true" name="isTrueAnswerOne"> True  <input type="checkbox"   value="false" name="isTrueAnswerOne"> False';
    }

    function isTrueAnswerTwo() {
        return '<input type="checkbox"  value="true" name="isTrueAnswerTwo"> True  <input type="checkbox"   value="false" name="isTrueAnswerTwo"> False';
    }

    function isTrueAnswerThree() {
        return '<input type="checkbox"  value="true" name="isTrueAnswerThree"> True  <input type="checkbox"   value="false" name="isTrueAnswerThree"> False';
    }

    function isTrueAnswerFour() {
        return '<input type="checkbox"  value="true" name="isTrueAnswerFour"> True <input type="checkbox"   value="false" name="isTrueAnswerFour"> False';
    }

    function resize_dqImage($uploader_response, $field_info, $files_to_upload) {
        /*   $this->load->library('image_moo');

          //Is only one file uploaded so it ok to use it with $uploader_response[0].
          $file_uploaded = $field_info->upload_path . '/' . $uploader_response[0]->name;
          // $file_thumb = $field_info->upload_path . '/' . $uploader_response[0]->name . "_thump.jpg";

          $this->image_moo->load($file_uploaded)->resize(600, 500)->save($file_thumb, true);

          return true; */
    }

    
    function getJson(){
        
        $today = date("Y-m-d") ;
        $results = $this->quiz_model->fetch_quizfortoday($today);
        $infoobj= new info();
        $infoobj->name = "Test Your Knowledge Daily!!";
        $infoobj->main= "<p>Daily quiz covers different topics , Serves like a tablet. Try it out!</p>";
        $infoobj->results="Thanks for completing the Quiz, You could find the next set of questions tomorrow";
        $infoobj->level1="You are an expert";
        $infoobj->level2="You have room for improvement";
        $infoobj->level3="You could get better";
        $infoobj->level4="Go on, Score more next time";
        $infoobj->level5="You are having a bad day";
        
        $return = new stdClass;
        $return->info=$infoobj;
        if($results!=null){
           // print_r($results);
        foreach($results as $row){
            $question_id = $row->question_id;
            $answers = $this->quiz_model->getAnswerJson($question_id);
             $row-> a= $answers;
        }
         $return->questions = $results;
        }
       // print_r($results);
        header('Content-Type: application/json');
        echo json_encode($return);
    }
}
class info {
    var $name;
    var $main;
    var $results;
    var $level1;
    var $level2;
    var $level3;
    var $level4;
    var $level5;
}