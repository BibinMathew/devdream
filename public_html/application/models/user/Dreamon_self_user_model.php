<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dreamon_self_user_model
 *
 * @author bibmathe
 */
class Dreamon_self_user_model extends CI_Model {

    //put your code here

    var $fromEmail = 'emailus@idreamias.com';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->library('PHPMailer');
    }

    function insertUser($data) {
        return $this->db->insert('dreamon_self_user', $data);
    }

    function sendEmail($to_email) {
        // $from_email = 'admin@something.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $text = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.idreamias.com/authentication/CustomUser/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />IdreamIAS Team';

        return $this->send($to_email, $subject, $text);
    }

    function resetPassEmail($email) {

        try {


            $subject = "Reset Your Password";
            $code = mt_rand('5000', '200000');
            $data = array(
                'forgot_passhash' => $code,
            );

            $this->db->where('email', $email);
            if ($this->db->update('dreamon_self_user', $data)) {
                $url = base_url() . "authentication/User_Authentication/newpassword/" . $code;
                $text = 'Dear User,<br /><br />Please click on the below  link to reset your current password.<br /><br /> ' . $url . '<br /><br /><br />Thanks<br />IdreamIAS Team';
                $subject = 'Reset Password - IDreamIAS';
                $this->send($email, $subject, $text);
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
        return false;
    }

    public function send($to_email, $subject, $text) {

        $this->phpmailer->IsHTML(true);
        $this->phpmailer->AddAddress($to_email);
        $this->phpmailer->IsMail();
        $this->phpmailer->From = 'emailus@idreamias.com';
        $this->phpmailer->FromName = 'IDreamIAS Registration';

        $this->phpmailer->Subject = $subject;
        $this->phpmailer->Body = $text;
        $this->phpmailer->Send();
        return true;
    }

    function updatePass($code, $pass) {
        $data = array('status' => 1, 'password' => $pass);

        $this->db->where('forgot_passhash', $code);
        $this->db->from('dreamon_self_user');
        if ($this->db->count_all_results() == 0)
            return false;
        else
            return $this->db->update('dreamon_self_user', $data);
    }

    function validCode($code) {

        $this->db->where('forgot_passhash', $code);
        $this->db->from('dreamon_self_user');
        if ($this->db->count_all_results() == 0)
            return false;
        return true;
    }

    function validEmail($email) {

        $this->db->where('status', 1);
        $this->db->where('email', $email);
        $this->db->from('dreamon_self_user');
        if ($this->db->count_all_results() == 0)
            return false;
        return true;
    }

    //activate user account
    function verifyEmailID($key) {
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        $this->db->from('dreamon_self_user');
        if ($this->db->count_all_results() == 0)
            return false;
        else
            return $this->db->update('dreamon_self_user', $data);
    }

    function getDetails($data) {
        $val1 = $this->db->escape($data['email']);
        $this->db->select('fname,lname,email');
        $this->db->from('dreamon_self_user');
        $this->db->where('email', $val1);

        $query = $this->db->get();

        $row = $query->row();

        if ($row) {
            $userData['first_name'] = $row->fname;
            $userData['last_name'] = $row->lname;
            $userData['email'] = $row->email;
            return $userData;
        } else
            return Array();
    }

    function login($data) {
        $bool = false;
        $username = $this->db->escape_str($data['email']);
        $password = $this->db->escape_str($data['password']);
        $password = md5($password);
        /* $this->db->where('email', $data['email']);
          $this->db->where('md5(password)', $data['password']);
          $this->db->where('status',1);
          $this->db->get('dreamon_self_user'); */
        try {

            $this->db->select('*');
            $this->db->from('dreamon_self_user');
            $this->db->where('email', $username);
            $this->db->where('status', 1);
            $this->db->where('password', $password);
            $query = $this->db->get();

           

            if (!$query) {

                $error = $this->db->error();
                throw new Exception("Exception E " . $error);
            }
            $result = $query->result();
            
            if (!empty($result)) {
                $bool = true;
            }
        } catch (Exception $ex) {
           $bool = false;
        }
         return $bool ;
    }

}
