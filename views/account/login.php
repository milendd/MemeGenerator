<h1>Login:</h1>

<form method="POST" action="<?= BASE_HOST ?>/account/login">
	Username: <input type="text" name="username" /><br/>
	Password: <input type="password" name="password" /><br/>
	<input type="Submit" value="Login"/>
</form>

<a href="<?= BASE_HOST ?>/account/register">Go register</a>
