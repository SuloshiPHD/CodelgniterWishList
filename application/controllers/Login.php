<?php

class Login extends CI_Controller {
    /**
     * load the wishlist if the user login session is set, if not
     * redirect to login page
     */
     public function index(){
         if($this->session->has_userdata('loginSession')){
             redirect('/wishlist');
         }else{
             $this->load->view('loginuserview');
         }

     }
}
?>