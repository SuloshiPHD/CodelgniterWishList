<?php

class Register extends CI_Controller {

    public function index (){

        if($this->session->has_userdata('login2')){
            redirect('/AdminDashboard');
        }else{
            $this->load->view('registeruserview');
        }

    }
}


?>
