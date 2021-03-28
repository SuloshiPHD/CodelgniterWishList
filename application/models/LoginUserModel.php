<?php

class LoginUserModel extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    //adding a user to db
    public function createUser($insertAllData)
    {
        $this->db->insert('users', $insertAllData);
        return $this->db->affected_rows() > 0;
    }

    //method to authenticate user
    public function authenticateUser($username, $password)
    {
        //$hashPwd = password_hash($password,PASSWORD_DEFAULT);

        $query = $this->db->get_where('users', array(
            'username' => $username
        ));

        $result = $query->result();
        log_message('debug', "Login Model results " . print_r($result, True));

        $successMessage = false;
        foreach ($result as $value) {

            if ($value->username == $username && password_verify($password, $value->password)) {
                $successMessage = true;
            }
        }
        log_message('debug', "Sucessmessage " . print_r($successMessage, True));
        return $successMessage;

    }

    //function to retrieve users in the database users table

    public function fetchUsers(){
        $query = $this->db->get('users');
        return $query->result();
        log_message('debug', "fetchUsers " . print_r($query->result(), True));

    }

}
?>
