<?php


class UserManager extends CI_Controller
{

    function index(){
        //load the very first view web 1.0 page
        $this -> load-> view('backbonetest');
    }

}