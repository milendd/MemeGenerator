<h1>Login</h1>

<form method="post" action="<?= BASE_HOST ?>/account/login">
	<div class="form-data">
		<label class="control-label" for="username">Username</label>
		<input class="custom-input" id="username" name="username" type="text" />
	</div>
	<div class="form-data">
		<label class="control-label" for="password">Password</label>
		<input class="custom-input" id="password" name="password" type="password" />
	</div>
	<input type="submit" value="Login" class="btn" />
</form>

<p>
	<a href="<?= BASE_HOST ?>/account/register">Register</a> if you are not already registered.
</p>
