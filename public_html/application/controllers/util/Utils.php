<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author bibmathe
 */
class Utils extends CI_Controller{
    //put your code here
    public function getBaseUrl(){
        echo base_url();
    }
}