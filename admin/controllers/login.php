<?php

class Login extends Controller{

    function __construct() {
        parent::__construct(); 
      
   /*     Session::init();
        $logged = Session::get('loggedIn');  
        
        if ($logged == true){            
            header('location: '.URL_ADMIN.'index');
            exit;
        }
    
    */
    }
    
    function index(){        
        $this->view->msg = 'Авторизация';
        $this->view->render('login/index', true);
    }
    
    function run(){        
        $this->model->run();
    }
    
    function logout(){
        Session::init();
        Session::destroy();   
        
       // var_dump($_SESSION);
        //    die();    
        header('location: '.URL_ADMIN.'login');
        exit;
    }
}
?>
