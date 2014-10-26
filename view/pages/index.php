<div id="index_page">	
<p>Последние поступления</p>
<?php 
	foreach($last_products as $item):?>

	<table>
		<tr>
		<tr>
			<th>
				<td id="index_title">
					<h3><a href="index.php?view=product&id=<?= $item['id'];?>"><?= $item['title'];?><a></h3>
				</td>
			</th>		
		</tr>
			<td>		
				<a href="index.php?view=product&id=<?= $item['id'];?>"><img src="userfiles/products/<?= $item['image'];?>" /><a>
			</td>
			<td>		
				<?= size_text($item['description']) . "...";?>
			</td>
		</tr>
		<tr>	
			<td id="index_price">		
				Цена: <?= $item['price'];?> грн
			</td>
		</tr>		
	</table><br />	

	<?php endforeach;?>
</div>