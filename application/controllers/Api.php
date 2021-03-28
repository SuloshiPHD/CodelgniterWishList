<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';


class Api extends \Restserver\Libraries\REST_Controller
{

    //function to fetch users
    function user_get()
    {
        $this->load->model('LoginUserModel');
        $dataUser = $this->LoginUserModel->fetchUsers();
        $this->response($dataUser);

    }

    //function to create user with wishlist description
    function user_post()
    {
        $this->load->model('LoginUserModel');
        $username = $this->post('username');
        $password = $this->post('password');
        $fullName = $this->post('name');
        $wishlistName = $this->post('wishlist_name');
        $wishlistDescription = $this->post('wishlist_desc');
        $wishlistOccasion = $this->post('wishlist_occasion');

        $hashPassword = password_hash($password,PASSWORD_DEFAULT);

        //pass the user and wishlist data to the array
        $insertAllData = array(
            'username' => $username,
            'password' => $hashPassword,
            'name' => $fullName,
            'wishlist_name' => $wishlistName,
            'wishlist_desc' => $wishlistDescription,
            'wishlist_occasion' => $wishlistOccasion

        );

        $sucessMessage = $this->LoginUserModel->createUser($insertAllData);
        $this->response($sucessMessage);

    }

    /** Creating user and fetching the username and password from the form.
     * Invoke the login model to authenticate user and create a
     * session to set user login data
     */
    function login_post()
    {
        $this->load->model('LoginUserModel');
        $username = $this->post('username');
        $password = $this->post('password');

        log_message('debug', "username " . print_r($username, True));
        $sucessMessage = $this->LoginUserModel->authenticateUser($username, $password);

        log_message('debug', "Sucessmessage2 " . print_r($sucessMessage, True));
        //setting the session if it is success
        if ($sucessMessage) {
            $this->session->set_userdata('loginSession', $username);

            $this->response("true");
//            redirect('/wishlist');

        } else {
            $this->response("false");
            //redirecting to the login view when the response is false
            //redirect('/Login');
        }

    }

    /**
     * fetching wishlist items from the database through wishlist Model
     */
    function item_get(){
     $uid = $this->session ->userdata('loginSession');
     $this->load->model('WishListModel');
     $results = $this->WishListModel->fetchItems($uid);
     $this->response($results);

    }
    /**
     * creating wishlist items and pass data to the database through wishlist Model
     */
    function item_post(){

        $this->load->model('WishListModel');
        $itemTitle=$this->post('title');
        $itemPrice=$this->post('price');
        $itemURL=$this->post('url');
        $itemPriority=$this->post('priority');
        $itemPriorityDesc=$this->post('priorityDescription');
        $username=$this->post('username');

        $wishlistData = array(
            'title' => $itemTitle,
            'price' => $itemPrice,
            'url' => $itemURL,
            'priority' => $itemPriority,
            'priorityDescription' => $itemPriorityDesc,
            'username' => $username

        );
        log_message('debug', "wishlist add item post " . print_r($wishlistData, True));
        $responseMessage = $this->WishListModel->AddWishlistItems($wishlistData);
        $this->response($responseMessage);

    }

    /**
     * updating the wishlist item
     */
    public function item_put(){

        $this->load->model('WishListModel');
        $itemTitle=$this->put('title');
        $itemPrice=$this->put('price');
        $itemURL=$this->put('url');
        $itemPriority=$this->put('priority');
        $itemPriorityDesc=$this->put('priorityDescription');
        $username=$this->put('username');

        $itemId = $this->put('id');

        $updateWishlistData = array(
            'title' => $itemTitle,
            'price' => $itemPrice,
            'url' => $itemURL,
            'priority' => $itemPriority,
            'priorityDescription' => $itemPriorityDesc,
            'username' => $username

        );
        log_message('debug', "wishlist item id to update: " . print_r($itemId, True));
        log_message('debug', "wishlist item updated " . print_r($updateWishlistData, True));
        $responseMessage = $this->WishListModel->UpdateWishlistItems($updateWishlistData,$itemId);
        $this->response($responseMessage);

    }
    /**
     * deleting a wishlist item
     */
    public function item_delete($id){

        $this->load->model('WishListModel');
        $success = $this->WishListModel->deleteWishlistItem($id);
        $this->response($success);
    }

    /**
     * unset the user session data when user has clicked the logout button
     */
    public function logout_post(){
        $this->session->unset_userdata('loginSession');
        $this->response("Success");
    }

    /**
     * fetching items for share view of the wishlist
     */
    public function share_get(){

        $uid =$this->session->userdata('sharedToUser');
        $this->load->model('WishListModel');
        $results = $this->WishListModel->fetchItems($uid);
        $this->response($results);

    }




}

?>
