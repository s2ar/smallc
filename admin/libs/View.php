<?php

class View {

    function __construct() {
        
    }

    public function render($name, $noInclude = false) {
    /**
     * Метод подключает шаблоны 
     * @name может быть строкой либо массивом строк
     */    
        if(is_array($name)) {
            if ($noInclude == false) require_once 'views/header.php';
            foreach ($name as $value) {
                require_once 'views/' . $value . '.php';
            }
            if ($noInclude == false) require_once 'views/footer.php';
            
        }elseif(is_string($name)){
            if ($noInclude == TRUE) {
                require_once 'views/' . $name . '.php';
            } else {
                require_once 'views/header.php';
                require_once 'views/' . $name . '.php';
                require_once 'views/footer.php';
            }    
        }       
    }

}

?>
