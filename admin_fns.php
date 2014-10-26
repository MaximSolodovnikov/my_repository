<?php
function db_connect() {
	$host = "localhost";
	$username = "salomuG";
	$password = "salomuG";
	$db = "bookseller";
	
	$connection = mysql_connect($host, $username, $password)
				or die("Error connect" . mysql_error());
	if(!connection || !mysql_select_db($db, $connection)) {
		return FALSE;
	}
	return $connection;
}

function db_result_to_array($result) {
	$res_array = array();
	$count = 0;
	while($row = mysql_fetch_array($result)) {
		$res_array[$count] = $row;
		$count++;
	}
	return $res_array;
}

function get_menu() {
	
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM `menu` WHERE `menu`.`title_url` != 'registration' AND `menu`.`title_url` != 'search' AND `menu`.`title_url` != 'forgot' AND `menu`.`title_url` != 'contacts' AND `menu`.`title_url` != 'catalogue' AND `menu`.`title_url` != 'cart'");
	$result = mysql_query($select_sql);
	$result = db_result_to_array($result);
	return $result;
}

function page_data($title) {
	
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM `menu` WHERE `menu`.`title_url` = '%s'",
							mysql_real_escape_string($title));
	$result = mysql_query($select_sql);
	$row = mysql_fetch_array($result);
	return $row;
}

function get_cat() {
	
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM `categories`");
	$result = mysql_query($select_sql);
	$result = db_result_to_array($result);
	return $result;
}

function get_products_by_cat($cat) {
	
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM `products` WHERE products.cat = '$cat'");
	$result = mysql_query($select_sql);
	$result = db_result_to_array($result);
	return $result;
}

/*Функция для вывода данных о конкретном товаре*/
function get_data_product($id) {
	
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM `products` WHERE `id` = '%s'",
							mysql_real_escape_string($id));
	$result = mysql_query($select_sql);
	$row = mysql_fetch_array($result);
	
	return $row;
}

function size_text($str) {
	$str = iconv('utf-8', 'windows-1251', $str);
	$str = substr($str, 0, 250);
	$str = iconv('windows-1251', 'utf-8', $str);
	
	return $str;
}

function get_last_products() {
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM `products` ORDER BY `id` DESC LIMIT 3");
	$result = mysql_query($select_sql);
	$result = db_result_to_array($result);
	
	return $result;
}

function forgot($login, $email) {
	db_connect();
	$select_sql = sprintf("SELECT login, email FROM users WHERE users.login = '%s' AND users.email = '%s'",
							mysql_real_escape_string($login),
							mysql_real_escape_string($email));
	
	$result = mysql_query($select_sql);
	if(mysql_num_rows($result) > 0) {
		return TRUE;
	}
	else return FALSE;
}

function change_password($pswd, $login) {
	db_connect();
	
	mysql_query("UPDATE users SET password = '$pswd' WHERE login = '$login'");
}

/*Функции корзины*/

function add_to_cart($id) {
	if(isset($_SESSION['cart'][$id]))
	{
		$_SESSION['cart'][$id]++;
		return TRUE;
	}
	else
	{
		$_SESSION['cart'][$id] = 1;
		return TRUE;
	}
	return FALSE;
}

function delete_prod_from_cart() {
	foreach($_SESSION['cart'] as $id => $qty)
	{
		if(isset($_POST['delete'])) 
		{
			unset($_SESSION['cart'][$id]);
		}
	}
}

function update_cart() {

}

function total_items($cart) {
	$num_items = 0;
	if(is_array($cart))
	{
		foreach($cart as $id => $qty)
		{
			$num_items += $qty;
		}
	}
	return $num_items;
}

function total_price($cart) {
	$total_price = 0.0;
	db_connect();
	if(is_array($cart))
	{
		foreach($cart as $id => $qty)
		{
			$select_sql = sprintf("SELECT price FROM products WHERE id = '%s'",
									mysql_real_escape_string($id));
			$result = mysql_query($select_sql);
			if($result)
			{
				$item_price = mysql_result($result, 0, 'price');
				$total_price += $item_price * $qty;
			}
		}
	}
	return $total_price;
}

 function search($query) 
{ 
    $query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (strlen($query) != '')
    { 
        if (strlen($query) < 3) {
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else 
        
        {
            db_connect();
            $q = " SELECT * FROM products WHERE title LIKE '%$query%' OR price LIKE '%$query%' OR author LIKE '%$query%' ";
            $result = mysql_query($q);

            if (mysql_affected_rows() > 0) 
            { 
                $row = mysql_fetch_array($result); 
                $num = mysql_num_rows($result);

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p><br /><br />';
				
				do {
				
				echo "<a href='index.php?view=product&id=" . $row['id'] ."'> {$row['title']}</a><br />";		
				}
				 while ( $row = mysql_fetch_array($result));	
			
				
            } 
            else 
            {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            }
        }  
    }
    if (strlen($query) == '')  {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
} 

function check_login($user) {
	db_connect();
	
	$select_sql = sprintf("SELECT login FROM users WHERE login = '%s'",
							mysql_real_escape_string($user));
	$result = mysql_query($select_sql);
	if(mysql_num_rows($result) > 0) {
		return FALSE;
	}
	else return TRUE;	
}

function registr($reg) {
	db_connect();
	
	$insert_sql = sprintf("INSERT INTO users (login, password, email) VALUES ('{$reg['login']}', '{$reg['password']}', '{$reg['email']}')");
	$result = mysql_query($insert_sql);
}

function check_user($login, $password) {
	db_connect();
	
	$select_sql = sprintf("SELECT login FROM users WHERE login = '%s' AND password = '%s'",
							mysql_real_escape_string($login),
							mysql_real_escape_string($password));
	$result = mysql_query($select_sql);
	if(mysql_num_rows($result) > 0) {
		return TRUE;
	}
	else return FALSE;	
}

function exit_cab() {
	unset($_SESSION['login']);
}

function get_comments($id, $section) {
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM comments WHERE comments.note_id = '%s' AND comments.section = '%s' ORDER BY comments.id DESC",
							mysql_real_escape_string($id),
							mysql_real_escape_string($section));
	$result = mysql_query($select_sql);
	$result = db_result_to_array($result);
	
	return $result;
	
	
}
/*
function select_data($table) {
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM $table");
	$result = mysql_query($select_sql);
	$result = db_result_to_array($result);
	return $result;
}

function get_data_product($table, $id) {
	
	db_connect();
	
	$select_sql = sprintf("SELECT * FROM $table WHERE $table.cat_id = '%s'",
							mysql_real_escape_string($id));
	$result = mysql_query($select_sql);
	$row = mysql_fetch_array($result);
	
	return $row;
}
*/