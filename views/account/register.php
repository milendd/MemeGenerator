<h1>Register:</h1>

<form method="POST" action="<?= BASE_HOST ?>/account/register">
	Username: <input type="text" name="username" /><br/>
	Password: <input type="password" name="password" /><br/>
	Email: <input type="email" name="email" /><br/>
	<input type="Submit" value="Register"/>
</form>
<a href="<?= BASE_HOST ?>/account/login">Go login</a>
