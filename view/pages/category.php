<?php foreach($categories as $item): ?>
<div id="products_by_cat">
	<table>
		<tr>
			<h3><a href="index.php?view=catalogue&category=product<?= $item['id'];?>"><?= $item['title'];?></a></h3>
		</tr>
		<tr>
			<td>
				
					<a href="index.php?view=product&id=<?= $item['id'];?>"><img src="userfiles/products/<?= $item['image'];?>" alt="product_image" /></a>
			</td>
			<td>			
				<p><?= size_text($item['description']) . "...." ?></p>
				<p>
					Автор: <?= $item['author'];?><br />
					Цена: <?= $item['price'];?> грн
				</p>
			</td>
		</tr>
	</table>
</div>
<?php endforeach; ?>