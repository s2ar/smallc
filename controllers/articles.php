<?php

class Articles extends Controller{

    function __construct() {
        parent::__construct();
      //  
        
    }
    
    function index(){
         header( "Location: /", true, 303 );
//        $this->view->msg = 'Статьи';
//        $this->view->msg = $this->model->getArticles();    
//        $this->view->alias = $this->view->msg;
//        $this->view->render('articles/index');
    }

    public function view($alias=false) {   
        if ($alias==FALSE) header( "Location: /articles", true, 303 );
//        require_once 'models/articles_model.php';
//        $model = new Articles_Model();        
        $this->view->article = $this->model->getArticle($alias);       
        if(empty($this->view->article)){ 
            $this->view->msg = 'Страница не найдена';
            $this->view->render('error/index');
            exit;
        }   
        $this->view->render('articles/article');
        
    }

}

?>
