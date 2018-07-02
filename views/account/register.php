<h1>Register</h1>

<form method="post" action="<?= BASE_HOST ?>/account/register">
    <div class="form-data">
        <label class="control-label" for="username">Username</label>
        <input class="custom-input" id="username" name="username" type="text" />
    </div>
    <div class="form-data">
        <label class="control-label" for="email">Email</label>
        <input class="custom-input" id="email" name="email" type="text" />
    </div>
    <div class="form-data">
        <label class="control-label" for="password">Password</label>
        <input class="custom-input" id="password" name="password" type="password" />
    </div>
    <input type="submit" value="Register" class="btn" />
</form>

<p>
    <a href="<?= BASE_HOST ?>/account/login">Login</a> if you already have an account.
</p>
