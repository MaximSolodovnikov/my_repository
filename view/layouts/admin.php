<!DOCTYPE html>
<html>
	<head>
		<title>Админка</title>
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/myscripts.js"></script>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<table id="table_site">
			<tr>
				<td>
					<div id="header">
						<img id="logo" src="userfiles/logo_final.png" alt="logo"/><div id="header_text">Админка "Букиниста"</div>
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
								
									<li><a href="admin.php?view=<?php echo $item['title_url'];?>" <? if($view == $item['title_url']) echo "class='menu_active'";?>><?php echo $item['title'];?></a></li>
								
								<? endforeach; ?>
							</ul>
						</div>					
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<?php require_once "view/pages/admin/" . $view . ".php";?>
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
