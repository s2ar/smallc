<?php

class Category extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        header("Location: /", true, 303);       
    }

    function view($id=false) {
        // TODO
        if (!is_numeric($id))
            header("Location: /", true, 303);

        $this->view->category = $this->model->getCategory($id);
        if($this->view->category==NULL){
            $this->view->msg = 'Страница не найдена';
            $this->view->render('error/index');
            exit;
        }         
        $objArticles = $this->loadModel('articles', true);
        $this->view->articles = $objArticles->getArticlesCat($id);
        $this->view->render('category/category');
    }

}

?>
