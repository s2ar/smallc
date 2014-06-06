<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();       
    }
    
    function index() {
       
        $this->view->msg = 'Главная страница';
        $this->loadModel("articles");
        $this->view->alias = $this->model->getArticles();
        $this->view->render('index/index');
    }
    



}
?>
