<?php

class Index extends Controller{

    function __construct() {
        parent::__construct();    
        Session::init();
        $logged = Session::get('loggedIn');  
        
        if ($logged == false){
            Session::destroy();
            header('location: '.URL_ADMIN.'login');
            exit;
        }
    }
    
    function index(){
       
        $this->view->msg = $this->rus2translit('Админка');      
        
        $this->view->render('index/index');
    }
    
     function def(){
       
        $this->view->msg = 'Главная страница';
        $this->view->render('index/index');
    }


}
?>
