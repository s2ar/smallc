<?php

class User extends Controller{

    function __construct() {
        parent::__construct(); 
        Session::init();
        $logged = Session::get('loggedIn');  
        
        if ($logged == false){
            Session::destroy();
            header('location: login');
            exit;
        }
    }
    
    function index(){        
        $this->view->msg = 'User сообщение';
        $this->view->render('user/index');
    }
    

}
?>
