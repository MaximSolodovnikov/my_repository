<?php if($_SESSION['cart']){?>
<div id="cart">
	<h3>Оформление заказа</h3><br />
<div id="accep_order">	
	<? if($_SESSION['cart'] && isset($_POST['order']) && !empty($_POST['name']) && !empty($_POST['s_name']) && !empty($_POST['phon']) && !empty($_POST['email'])) 
	{
		echo "<p>Ваш заказ успешно принят. В ближайшее время, с вами свяжуться наши менеджеры для подтверждения заказа.</p>";
	}?>
</div>
	<table>
		<tr>
			<th>
				Название товара
			</th>
			<th>
				Цена товара
			</th>
			<th>
				Количество товара
			</th>
			<th> 
				Всего
			</th>
			<th> 
				
			</th>
		</tr>
		
		<?php foreach($_SESSION['cart'] as $id => $quantity):
		$product = get_data_product($id);?>
			  
		<tr>
			<td>
				<?= $product['title'];?>
			</td>
			<td>
				<?= number_format($product['price'], 2);?> грн
			</td>
			<td>
				<?= $quantity;?> шт
			</td>
			<td>
				<?= number_format(($product['price'] * $quantity), 2);?> грн
			</td>
		</tr>
		
		<? endforeach; ?>

	</table>
	
	<p>Общая сумма: <?php echo number_format(($_SESSION['total_price']), 2);?> грн</p><br />
	
	<form action="index.php?view=order" method="POST">
		<label for="login">Введите имя:</label><br />
				<input type="text" name="name" size="20" /><br />
				<label for="s_name">Введите фамилию:</label><br />
				<input type="text" name="s_name" size="20" /><br />
				<label for="phon">Введите контактный телефон:</label><br />
				<input type="text" name="phon" size="20" /><br />
				<label for="email">Введите e-mail:</label><br />
				<input type="text" name="email" size="20" /><br /><br />
		<input type="submit" name="order" value="Сделать заказ" />
	</form>
	<br />

	
</div>
<?} 

if($_SESSION['cart'] && isset($_POST['order']) && !empty($_POST['name']) && !empty($_POST['s_name']) && !empty($_POST['phon']) && !empty($_POST['email'])) 
	{
		$name = $_POST['name'];
		$s_name = $_POST['s_name'];
		$phon = $_POST['phon'];
		$email = $_POST['email'];
		
		$date = date('Y-m-d');
		$time = date('H:i:s');
		
		foreach($_SESSION['cart'] as $id => $quantity):
		$product = get_data_product($id);
			$insert_sql = sprintf("INSERT INTO `orders` (name, s_name, phon, email, date, time, product, product_id, price, qty) VALUES ('$name', '$s_name','$phon','$email','$date','$time','{$product['title']}','{$product['id']}','{$product['price']}','$quantity')");
			$result = mysql_query($insert_sql);
		endforeach;
	}?>