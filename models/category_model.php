<?php

class Category_Model extends Model {
    
   
    function __construct() {
        parent::__construct();  
 
    }
   
    function getCategoryAll(){          
        $category=array();
//      Подготовка данных, чтобы просмотреть все дерево
        $this->objTree->Full('');
        
        // Проверим класс на ошибки
        if (!empty($this->objTree->ERRORS_MES)) {
            unset ($this->objTree->ERRORS_MES);
            return false;
        }
        
        foreach ($this->objTree->NextRow() as $item) {            
            $category[]=$item;
        }        
        return  $category; 
    }
    
    function getCategory($id){       
        $res = $this->db->selectCell('SELECT category_name FROM ?_category WHERE category_id=?', $id);
        return $res;
    }
    
    function editCategory($id, $name) {
        $sql = 'SELECT * FROM category WHERE category_id = ' . (int)$id;
        $res = $this->db->selectRow($sql);
        if (empty($res)) {
            return false;
        }
        
        $sql = $this->objTree->GetUpdateSQL($sql, $name);
        if (!empty($sql)) {
            $res = $this->db->query($sql);            
        }
        return true;
        
         
    }
    
    function addCategory($id, $name) {        
        $this->objTree->Insert($id, '', $name);
        
        // Проверим класс на ошибки
        if (!empty($this->objTree->ERRORS_MES)) {
            unset ($this->objTree->ERRORS_MES);
            return false;
        }
        return true;
    }
    
    function delCategory($id){      
        $this->objTree->Delete($id);   
        // Проверим класс на ошибки
        if (!empty($this->objTree->ERRORS_MES)) {
            unset ($this->objTree->ERRORS_MES);
            return false;
        }
        return true;
    }
     
    function moveCategory($type, $id, $post){
        /**
         * @type - параметр определяет задачу. 
         *  - form - выдает данные для формы
         *  - do   - выполняет само перемещение; 
         */
        if($type=='form'){
            // Получаем данные для первой формы
            // Prepare the restrictive data for the first method:
            // Swapping nodes within the same level and limits of one parent with all its children
            $current_category = $this->objTree->GetNodeInfo($id);
            $this->objTree->Parents($id, array('category_id'), array('and' => array('category_level = ' . ($current_category[2] - 1))));
            // Проверим класс на ошибки
            if (!empty($this->objTree->ERRORS_MES)) {
                unset ($this->objTree->ERRORS_MES);
                return false;
            }
            $item = $this->objTree->NextRow();
            $this->objTree->Branch($item['category_id'], array('category_id', 'category_name'), array('and' => array('category_level = ' . $current_category[2])));
            $dataForm=array();
            while ($item = $this->objTree->NextRow()) {
                $dataForm[0][]=$item;
            }
            
            // Получаем данные для второй формы
            // Prepare the data for the second method:
            // Assigns a node with all its children to another parent
            $this->objTree->Full(array('category_id', 'category_level', 'category_name'), array('or' => array('category_left <= ' . $current_category[0], 'category_right >= ' . $current_category[1])));
            if (!empty($this->objTree->ERRORS_MES)) {
                unset ($this->objTree->ERRORS_MES);
                return false;
            }
            while ($item = $this->objTree->NextRow()) {
                $dataForm[1][]=$item;                
            }
            return $dataForm;
        }  elseif ($type=='do1') {
            // Перемещаем по первой форме
            // Change node ($_GET['category_id']) position and all its childrens to
            // before or after ($_POST['position']) node 2 ($_POST['category2_id'])
            $this->objTree->ChangePositionAll($id, $post['category2_id'], $post['position']);
            if (!empty($this->objTree->ERRORS_MES)) {
                unset ($this->objTree->ERRORS_MES);
                return false;
            }
            return true;            
       
        }  elseif ($type=='do2') {
            // Перемещаем по второй форме
            // Move node ($_GET['category_id']) and its children to new parent ($_POST['category2_id'])
            $this->objTree->MoveAll($id, $post['category2_id']);
            if (!empty($this->objTree->ERRORS_MES)) {
                unset ($this->objTree->ERRORS_MES);
                return false;
            }
            return true;
            
        }
    }
    

    

}