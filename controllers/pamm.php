<?php


class Pamm extends Controller{

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
        $this->view->msg = 'Pamms';        
        $this->view->html = $html;       
        $this->view->render('pamm/index');        
    }

}
?>