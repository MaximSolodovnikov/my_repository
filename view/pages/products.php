<div id="page_product">
	<table>
		<tr>
			<td>	
				<h3><?= $product['title'];?></h3><br /><br />
					<img src="userfiles/products/<?= $product['image'];?>" alt="product_image" />
					
						<h4><a id="add_to_cart" href="index.php?view=add_to_cart&id=<?= $product['id'];?>">Добавить в корзину</a>:</h4>
					
					
					<p id="prod_auth_price">
						Автор: <?= $product['author'];?>
					</p>
					
					<p> <?= $product['description'];?></p>
					
					<p id="prod_auth_price">
						Цена: <?= $product['price'];?> грн <br />
					</p>

					
			</td>
		<tr>
			<tr>
				<td>
					<h4>Ваши отзывы:</h4>
				</td>
			<tr>
			<td id="displ_comment">
				Автор: Максим <br /><br />
				Отзыв:<br /><br />
				Очень интересная книга. Всем реккомендую. Хочу купить себе такую. Огромнейшее спасибо автору за то, что он ее написал. Не знаю, что можно еще написать про эту книгу. А еще у нее очень красивая обложка. И в трудную минуту можно вырвать пару листиков, чтобы подтереть жопу :)
			</td>
		<tr>
		
		<tr>
			<td>
				<h4>Оставить отзыв:</h4>
			</td>
		<tr>
			<td>
				<form id="form_comment" action="#" method="POST">
					<label for="author">Автор:</label><br />
					<input type="text" name="author" /><br />
					<label for="author">Отзыв:</label><br />
					<textarea name="comment_text" cols="30" rows="4"></textarea><br />
					<input type="submit" name="sent_comment" value="Оставить отзыв"/><br />
				</form>
			</td>
		</tr>
		</tr>
		</tr>
		
	</table>
</div>