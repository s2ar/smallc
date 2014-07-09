<?php
class Pamm_Model extends Model {
    
	function __construct() {
    	parent::__construct();
        include($_SERVER['DOCUMENT_ROOT'].'/libs/simple_html_dom.php');
	}
}
?>