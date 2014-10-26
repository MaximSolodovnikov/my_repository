<?php foreach($catalogue as $item):?>

<tr>
	<td>
		<div id="content">
			<a href="index.php?view=catalogue&category=<?= $item['title_url'];?>"><?= $item['title'];?></a>
		</div>
	</td>
</tr>

<?php endforeach;?>