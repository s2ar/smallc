 <?php

class View {

    function __construct() {      
    }
    
    public function render($name, $noInclude = false) {
        
        if($this->defineRequest()) {
            require_once 'views/'.$name.'.php';
            die();
        }
        
        if ($noInclude==TRUE) {
            require_once 'views/'.$name.'.php';
        } else {
            require_once 'views/header.php';
            require_once 'views/'.$name.'.php';
            require_once 'views/footer.php';
        }
    }
    
    private function defineRequest(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            // Если к нам идёт Ajax запрос, то ловим его
            return true;            
        }
       //Если это не ajax запрос
       return false;
    }

}

?>
