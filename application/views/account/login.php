<form action="/account/login" class="register" method="post">

	<div class="err__msg"><?php if (isset($msg)) echo $msg ?></div>

	<label class="register__label">
		Username
		<input class="register__input" autofocus name="login" type="text" placeholder="username or email" <?= isset($login) ? 'value=' . $login : '' ?>>
	</label>

	<label class="register__label">
		Password
		<input class="register__input" name="pass" type="password" placeholder="password" <?= isset($pass) ? 'value=' . $pass : '' ?>>
	</label>

	<?php if (isset($csrf)) : ?>
		<input type="hidden" name="_csrf" value="<?= $csrf ?>">
	<?php endif ?>

	<input class="register__submit" type="submit" value="Login">
</form>

<?= $this->user->name() ?>

<style>
	.err__list {
		margin: 0;
		display: flex;
		flex-direction: column;
		align-items: start;
		justify-content: start;
	}

	.err__item {
		color: #dd5145;
		border: 1px solid #C23D34;
		border-radius: 5px;
		padding: 5px 25px;
		margin-bottom: 10px;
	}

	.err__msg {
		color: #dd4f42;
		font-size: 12px;
		padding: 5px;
		/* border: 1px solid #DD4F42; */
		border-radius: 5px;
		margin-bottom: 10px;
	}

	.register {
		display: inline-flex;
		flex-direction: column;
		align-items: start;
		justify-content: start;
		border: 1px solid #C1C1C1;
		padding: 40px;
		border-radius: 10px;
	}

	.register__label {
		display: flex;
		flex-direction: column;
		margin-bottom: 10px;
	}

	.register__input {
		border: 1px solid #282C34;
		border-radius: 5px;
		padding: 10px;
		outline: 0;
	}

	.register__submit {
		cursor: pointer;
		padding: 3px 10px;
		margin-top: 15px;
		border-radius: 5px;
		border: 1px solid #2C313C;
		padding: 10px;
	}
</style>