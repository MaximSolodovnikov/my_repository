<div id="info">
	<?= $info;?>
</div>
<table id="registration">
	<tr>
		<td>
			<form action="index.php?view=registration" method="POST" class="validate_form">
					
						Введите логин:<br />
						<input type="text" name="login" size="20" /><br />
						
						<label for="password">Введите пароль:</label><br />
						<input type="password" name="password" size="20" /><br />
						
						<label for="password2">Повторите пароль:</label><br />
						<input type="password" name="password2" size="20" /><br />
						
						<label for="email">Введите e-mail:</label><br />
						<input type="text" name="email" size="20" /><br /><br />
						
						<input type="submit" name="registration" value="Зарегистрироваться" /><br />
				</form>
			</div>
		</td>
	</tr>
</table>