<?php 
require_once "fns.php";

session_start();
if(!isset($_SESSION['cart'])) 
{
	$_SESSION['cart'] = array();
	$_SESSION['total_items'] = 0;
	$_SESSION['total_price'] = '0.00';
}

$view = empty($_GET['view']) ? 'index' : $_GET['view'];


$page_title = page_data($view);

switch($view) {
	
	case "index":
		$last_products = get_last_products();
	break;
	
	case "catalogue":
		$category = $_GET['category'];
		$page_title = get_products_by_cat($table, $title);
		$catalogue = select_data($view);
	break;
	
	/*case "category":
		$title_cat = $_GET['id'];
		$products = get_products_by_cat($title_cat);
	break;*/
	
	/*case "category":
		$category = select_data($view);
	break;*/
	
	
	case "products":
		/*$id_product = $_GET['id'];
		$product = get_data_product($id_product);*/
		
		/*$cat = $_GET['category'];
		if(!empty($cat))
		{
			$page_title = get_data_product($view, $cat);
		}
		else
			{
				$page_title = page_data($view);
			}*/
			
	break;
	
	/*case "add_to_cart": При обращении к функции, как элементу url - нужно делать переадресацию на этуже страницу
		$id_product = $_GET['id'];
		$add_item = add_to_cart($id_product);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		header("Location: index.php?view=product&id=" . $id_product);
	break;*/
	
	case "update_cart":
		delete_prod_from_cart();
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		header("Location: index.php?view=cart");
	break;
	
	case "registration":
		if(isset($_POST['registration']) && (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])))
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			$email = $_POST['email'];
			
			if($password != $password2) $info = "Пароли не совпадают";
			if(!check_login($login)) $info = "Пользователь с таким логином уже существует. Выберете себе другой.";
			
			if(($password == $password2) && check_login($login))
			{
				$reg['login'] = $_POST['login'];
				$reg['password'] = $_POST['password'];
				$reg['email'] = $_POST['email'];
				registr($reg);
				header("Location: index.php?view=index");
			}
		}
		if((isset($_POST['registration']) && (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['email']))))
		{
			$info = "Заполните все поля";
		}
	break;

	case "login_cab":
		if(isset($_POST['enter']) && (!empty($_POST['login']) && !empty($_POST['password'])))
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
		
			if(check_user($login, $password))
			{
				$_SESSION['login'] = $login;
				header("Location: index.php?view=index");
			}
			else
			{
				header("Location: index.php?view=index");
			}
		}	
	break;
	
	case "cart":
		$info = "Для оформления заказа, Вам необходимо зарегистрироваться";
	break;
	
	case "exit_cab":
		if(isset($_POST['exit']))
		{
			exit_cab();
			}
			
			header("Location: index.php?view=index");
		
	break;
	
	case "forgot":
		if(isset($_POST['forgot']) && (!empty($_POST['login']) && !empty($_POST['email'])))
		{
			$pswd = rand(10000, 99999);
			$login = $_POST['login'];
			$email = $_POST['email'];
			if(forgot($login, $email)) 
			{
				$to = $email;
				$subject = "Восстановление пароля bookseller.url.ph";
				$msg = "Ваш новый пароль: " . $pswd . " используйте его для входа в личный кабинет";
				mail($to, $subject, $msg);
				change_password($pswd, $login);
				$info = "Новый пароль был выслан Вам на e-mail.";
			}
			else 
			{
				$info = "Пользователя с таким login и e-mail не найдено.";
			}
		}
		if((isset($_POST['forgot']) && (empty($_POST['login']) || empty($_POST['email']))))
		{
			$info = "Заполните все поля";
		}
		
	break;

}
$arr = array('index', 'catalogue', 'category', 'product', 'cart', 'add_to_cart', 'update_cart', 'contacts', 'registration', 'order', 'forgot');
if(!in_array($view, $arr)) die("Такого адреса не существует!");

require_once "view/layouts/site.php";