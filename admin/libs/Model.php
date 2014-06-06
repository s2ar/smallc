<?php

class Model {
    protected $db;
    protected $db_tree;
    protected $objTree;
    
    function __construct() {
       $this->db = Database::init();
    
       $this->objTree = new dbtree('category', 'category', $this->db);
    }
    
    function getTree() {
    //    $current_category = $this->objTree->GetNodeInfo($id);
        $this->objTree->Full(array('category_id', 'category_level', 'category_name'));
        if (!empty($this->objTree->ERRORS_MES)) {
            unset ($this->objTree->ERRORS_MES);
            return false;
        }
        $tree = array();
        while ($item = $this->objTree->NextRow()) {
            $tree[]=$item;                
        }
        return $tree;
    }
    
}

?>
