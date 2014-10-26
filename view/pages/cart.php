<?php if($_SESSION['cart']){?>
<div id="cart">
	<h3>Ваша корзина товаров</h3><br />
	
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
	
	<form action="index.php?view=update_cart" method="POST">
		<input type="submit" name="delete" value="Очистить корзину" />
	</form>
	<br />
<?php if(!empty($_SESSION['login'])) {?>
	<a href="index.php?view=order">Оформить заказ</a>
	<?} else ?>
	
	<div id="info">
		<?= $info;?>
	</div>
	
	
</div>
<?} else {?>
	<h3  id="cart">Ваша корзина пустая</h3>
<?}?>