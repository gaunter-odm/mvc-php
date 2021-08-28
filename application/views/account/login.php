<form action="/account/login" method="post">
	<label>Login <input name="login" type="text"></label>
	<label>Password <input name="pass" type="password"></label>
	<input type="submit" value="Login">
</form>

<p>Login: <?= $_POST['login'] ?></p>
<p>Pass: <?= $_POST['pass'] ?></p>

<style>
	form {
		display: flex;
		flex-direction: column;
		align-items: start;
	}
</style>