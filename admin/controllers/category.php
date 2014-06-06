<?php

class Category extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');

        if ($logged == false) {
            Session::destroy();
            header('location: ' . URL_ADMIN . 'login');
            exit;
        }
    }

    function index() {

        $this->view->category = $this->model->getCategoryAll();
        $this->view->render('category/index');        
    }

    function edit($id=false) {

        if (!isset($_POST['edit'])) {
            $_POST['edit'] = null;
        }
        // Если переменная "edit" содержит 1 - значит форма отправлена с данными, нужно изменять
        // Если переменная "edit" содержит NULL - значит нужно вывести форму с данными
        if ($_POST['edit'] == 1 AND is_numeric($id)) {
            if(!$this->model->editCategory($id, $_POST['category'])){
                // Обработка ошибки - пока не реализованно
                $this->index();                
            }
            $this->index();
        } elseif(is_numeric($id)) {
            $this->view->category = $this->model->getCategoryAll();
            $this->view->category_name = $this->model->getCategory($id);
            $this->view->category_id = $id;
            
            $this->view->render(array('category/index','category/edit'));
        } else{
            $this->index();
        }
    }

    function view($id=false) {
        // TODO
        if (!is_numeric($id))
            header("Location: " . URL_ADMIN . "category", true, 303);
//        require_once 'models/articles_model.php';
//        $model = new Articles_Model();

        $this->view->category = $this->model->getCategory($id);
        $objArticles = $this->loadModel('articles', true);
        $this->view->articles = $objArticles->getArticlesCat($id);
        $this->view->render('category/category');
    }
    
    function move($id=false) {
        
        if (!isset($_POST['move'])) {
            $_POST['move'] = null;
        }
        // Если переменная "move" содержит 1 - значит форма отправлена с данными, нужно переместить по форме 1
        // Если переменная "move" содержит 2 - значит форма отправлена с данными, нужно переместить по форме 2
        // Если переменная "move" содержит NULL - значит нужно вывести форму с данными
        if ($_POST['move'] == 1 AND is_numeric($id)) {
            if(!$this->model->moveCategory('do1', $id, $_POST)){
                    // Обработка ошибки - пока не реализованно
// TODO
                $this->view->msg = "Перемещение категории завершено с ошибкой!";
                $this->index();
                exit ();
            }
            $this->view->msg = "Категория перемещена";
            $this->index();
        }elseif($_POST['move'] == 2 AND is_numeric($id)) {    
            if(!$this->model->moveCategory('do2', $id, $_POST)){
                    // Обработка ошибки - пока не реализованно
// TODO
                $this->view->msg = "Перемещение категории завершено с ошибкой!";
                $this->index();
                exit ();
            }
            $this->view->msg = "Категория перемещена";
            $this->index();  
            
        } elseif(is_numeric($id)) {
            $this->view->category = $this->model->getCategoryAll();
            $this->view->dataForm = $this->model->moveCategory('form', $id, null);        
            $this->view->category_id = $id;
            
            $this->view->render(array('category/index','category/move'));
        } else{
            $this->index();
        }
        
    }

    function add($id=false) {
        if (!isset($_POST['add'])) {
            $_POST['add'] = null;
        }
        // Если переменная "add" содержит 1 - значит форма отправлена с данными, нужно создать запись
        // Если переменная "add" содержит NULL - значит нужно вывести форму 
        if ($_POST['add'] == 1 AND is_numeric($id)) {
           if(!$this->model->addCategory($id, $_POST['category'])){
                $this->view->category = $this->model->getCategoryAll();            
                $this->view->category_id = NULL;
                $this->view->render(array('category/index','category/add'));
            }   
            $this->index();
        } else { 
            $this->view->category = $this->model->getCategoryAll();
            $this->view->category_id = $id;
            $this->view->render(array('category/index','category/add'));
        }
    }

    function del($id=false) {

        if ($id == FALSE) {
            $this->view->msg = "Удаление невозможно, не задан id";
            $this->view->category = $this->model->getCategoryAll();
            $this->view->render('category/index');
            exit();
        }
//        var_dump($this->model->delArticle($id));
//        die ();
        if(is_numeric($id)){
            if ($this->model->delCategory($id)) {
                $this->view->msg = "Категория удалена!";
            } else {
                $this->view->msg = "Не возможно удалить категорию";
            }
            $this->view->category = $this->model->getCategoryAll();
            $this->view->render('category/index');
        }else{
            $this->view->render('error/index');
        }
    }

}

?>
