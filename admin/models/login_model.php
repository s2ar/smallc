<?php

class Login_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function run() {

        $id = $this->db->selectCell('SELECT user_id FROM users 
                                   WHERE user_login = ? AND user_password = ?', $_POST['login'], md5($_POST['password']));

        if (is_numeric($id)) {

            Session::init();
            Session::set('loggedIn', true);

            header('location: ' . URL_ADMIN . 'index');
        } else {
            header('location: ' . URL_ADMIN . 'login');
        }
    }

}