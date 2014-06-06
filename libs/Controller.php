<?php

class Controller {

    protected $model;
    protected $tree;
    
    function __construct() {  
        $this->model = new Model(); 
        $this->tree = $this->model->getTree();
        
        $this->view = new View();
        $this->view->tree = $this->tree;
    }
    
    public function loadModel($name, $return=false){
    /**
     * Параметр @return - возвращать ли обьект 
     * 
     */    
        $path = 'models/'.$name.'_model.php';
        
        if (file_exists($path)) {
            require_once 'models/'.$name.'_model.php';
            
            $modelName = $name.'_Model';
            if(!$return){
                $this->model = new $modelName();            
            }else{
                return new $modelName();
            }
        }
        
    }

}

?>
