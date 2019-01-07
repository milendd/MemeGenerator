<h1>Вход</h1>

<form method="post" action="<?= BASE_HOST ?>/account/login">
	<div class="form-data">
		<label class="control-label" for="username">Потребителско име</label>
		<input class="custom-input" id="username" name="username" type="text" />
	</div>
	<div class="form-data">
		<label class="control-label" for="password">Парола</label>
		<input class="custom-input" id="password" name="password" type="password" />
	</div>
	<input type="submit" value="Вход" class="btn" />
</form>

<p>
	<a href="<?= BASE_HOST ?>/account/register">Регистрация</a> ако нямате акаунт.
</p>
