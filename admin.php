<?php 
require_once "admin_fns.php";

session_start();

$view = empty($_GET['view']) ? 'index' : $_GET['view'];



switch($view) {
	
	case "index":
		
	break;

}
$arr = array('index', 'books', 'users');
if(!in_array($view, $arr)) die("Такого адреса не существует!");

require_once "view/layouts/admin.php";