<?php

class Wishlist extends CI_Controller
{
    /**
     * load the wishlist if the user login session is set, if not
     * redirect to login page
     */
    public function index()
    {

        if ($this->session->has_userdata('loginSession')) {
            $this->load->view('wishlistview');

        } else {
            redirect('/Login');
        }
    }
    /**
     * method to load the wishlist view to shared user (setting the session)
     * @param $username username of the current user who has created the wishlist
     */

    public function username($username){
        $this->session->set_userdata('sharedToUser',$username);
        $this->load->view('wishlistshareview');
    }


}


?>
