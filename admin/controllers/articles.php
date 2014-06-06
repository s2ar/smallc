<?php

class Articles extends Controller{

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
       
        $this->view->articles = $this->model->getArticlesAll(); 
        $this->view->render('articles/index');
    }
    
    function edit($id=false){
         
        if (!isset($_POST['edit'])){$_POST['edit'] = null;}       
        // Если переменная "edit" содержит 1 - значит форма отправлена с данными, нужно изменять
        // Если переменная "edit" содержит NULL - значит нужно вывести форму с данными
        if($_POST['edit']==1) { 
           
            $_POST['article_alias'] = $this->rus2translit($_POST['article_alias']);
            unset ($_POST['edit']);
            $data = $this->model->editArticle($_POST);
            
           
            if (is_int($data)){
                $redirect = 'location: '.URL_ADMIN.'articles/view/'.$id;           
                header($redirect);exit;
            exit();
            } else {return false;}
            
            
        }else {
           if ($id==FALSE) header( "Location: ".URL_ADMIN ."articles", true, 303 );
           $this->view->article = $this->model->getArticle($id);  
           $this->view->tree = $this->model->getTree(); 
           $this->view->render('articles/edit');
        }            
       
      
    }
    
    function view($id=false) {   
        if ($id==FALSE) header( "Location: ".URL_ADMIN ."articles", true, 303 );
//        require_once 'models/articles_model.php';
//        $model = new Articles_Model();
        
        $this->view->article = $this->model->getArticle($id);
        $this->view->render('articles/article');
        
    }
    
    function add(){
        if (!isset($_POST['add'])){$_POST['add'] = null;}       
        // Если переменная "add" содержит 1 - значит форма отправлена с данными, нужно создать запись
        // Если переменная "add" содержит NULL - значит нужно вывести форму 
        if($_POST['add']==1) {  
            $_POST['article_alias'] = $this->rus2translit($_POST['article_alias']);
            unset ($_POST['add']);
            $id_new = (integer)$this->model->addArticle($_POST);       
            if(is_int($id_new)==true){                
                $redirect = 'location: '.URL_ADMIN.'articles/view/'.$id_new;           
                header($redirect);exit;
            } else {return false;}             
        }else {          
           $this->view->tree = $this->model->getTree();          
           $this->view->render('articles/add');
        }            
       
      
    }
    
    function del($id=false) { 
        
        if ($id==FALSE) {
           $this->view->msg = "Удаление невозможно, не задан id";
           $this->view->articles = $this->model->getArticlesAll();
           $this->view->render('articles/index');
        }
//        var_dump($this->model->delArticle($id));
//        die ();
        if ($this->model->delArticle($id)==1){
            $this->view->msg = "Cтатья удалена!";            
        } else {
            $this->view->msg = "Не возможно удалить статью";
        }
        $this->view->articles = $this->model->getArticlesAll(); 
        $this->view->render('articles/index');
        
    }


}
?>
