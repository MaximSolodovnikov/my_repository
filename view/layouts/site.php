<!DOCTYPE html>
<html>
	<head>
		<title><?= $page_title['title'];?></title>
		<!--<link href="http://bookseller.url.ph/favicon.ico" rel="shortcut icon" type="image/x-icon" />-->
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/myscripts.js"></script>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
<?php if(empty($_SESSION['login'])) {?>


	<div id="login_cab">
		<form action="index.php?view=login_cab" method="POST">
			<label for="login">Логин:</label><br />
			<input type="text" name="login" size="10" /><br />
			<label for="login">Пароль:</label><br />
			<input type="password" name="password" size="10" /><br />
			<input type="submit" name="enter" value="Вход" /><br />
			<a href="index.php?view=registration" <?php if($view == 'registration') echo "class = 'menu_active'";?>>Регистрация</a> <br />
			<a href="index.php?view=forgot" <?php if($view == 'forgot') echo "class = 'menu_active'";?>>Восстановление пароля</a>
		</form>
	</div>	
<?} else {?>
		<div id="exit_cab">
			<form action="index.php?view=exit_cab" method="POST">
				Приветствую<span id="username"><?=$_SESSION['login'];?></span><br />
				<input type="submit" name="exit" value="Выход" /><br />
			</form>
		</div>
	<div id="login_cab">			
		<h3>Ваш заказ</h3> 
		Количество: <?php echo $_SESSION['total_items'];?> шт <br />
		Сумма: <?php echo number_format(($_SESSION['total_price']), 2);?> грн <br />
	</div>
<?}?>
		<table id="table_site">
			<tr>
				<td>
					<div id="header">
						<img id="logo" src="userfiles/logo_final.png" alt="logo"/><div id="header_text">Программная система "Букинист"</div>
					</div>
				</td>
			</tr>	
			<tr>
				<td >
					<div  id="menu">
						<div id="search">
							<form action="index.php?view=index" method="POST">
								<input type="text" name="query" />
								<input type="submit" name="search_btn" value="Поиск" />
							</form>
									<div id="search_result">
									<?php if(!empty($_POST['query'])) 
										{ 
											$search_result = search($_POST['query']); 
											echo $search_result; 
										}?>
									</div>
						</div>	
						<div class="menu_active">
							
							<ul>
								<?php $menu = get_menu();
								foreach ($menu as $item):?>
								
									<li><a href="index.php?view=<?php echo $item['title_url'];?>" <? if($view == $item['title_url']) echo "class='menu_active'";?>><?php echo $item['title'];?></a></li>
										


								<? endforeach; ?>
							</ul>
						</div>					
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<?php require_once "view/pages/" . $view . ".php";?>
				</td>
			</tr>
			<tr>
				<td>
					<div id="footer">
						<span>Разработал: Солодовников М.В.</span>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>
