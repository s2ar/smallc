<?php

class Login extends Controller{

    function __construct() {
        parent::__construct();        
    }
    
    function index(){ 
        $this->loadModel("articles");
        $this->view->alias = $this->model->getArticles();
        $this->view->render('login/index');
    }
    
    function run(){        
        $this->model->run();
    }
    
    function logout(){
        Session::init();
        Session::destroy();    
                
        header('location: '.URL.'login');
        exit;
    }
}
?>
