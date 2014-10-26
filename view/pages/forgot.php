<div id="info">
	<?= $info;?>
</div>
<tr>
	<td>
		<div id="content">
			<div id="registration">
				<form action="index.php?view=forgot" method="POST" class="validate_form">
					<label for="login">Введите логин:</label><br />
					<input type="text" name="login" size="20" /><br />
					<label for="email">Введите e-mail:</label><br />
					<input type="text" name="email" size="20" /><br /><br />
					<input type="submit" name="forgot" value="Отправить" /><br />
				</form>
			</div>
		</div>
	</td>
</tr>