<form class="register" method="post" action="/account/register">

	<div class="err__msg"><?php if (isset($msg)) echo $msg ?></div>

	<label class="register__label">
		Name
		<input class="register__input" value="name" name="name" type="text" placeholder="your name...">
	</label>

	<label class="register__label">
		Username
		<input class="register__input" value="username" name="username" type="text" placeholder="nickname">
	</label>

	<label class="register__label">
		E-mail
		<input class="register__input" value="test@mail.cmo" name="email" type="email" placeholder="examplpe@mail.com">
	</label>

	<label class="register__label">
		Password
		<input class="register__input" value="qqqqqq" name="password" type="password" placeholder="**********">
	</label>

	<label class="register__label">
		Confirm password
		<input class="register__input" value="qqqqqq" name="confirm" type="password" placeholder="**********">
	</label>

	<?php if (isset($csrf)) : ?>
		<input type="hidden" name="_csrf" value="<?= $csrf ?>">
	<?php endif ?>

	<input class="register__submit" type="submit" value="Register">
</form>

<? if (isset($vars['error_messages'])) : ?>
	<h2 class="err__head">Errors</h2>

	<ul class="err__list">
		<? foreach ($vars['error_messages'] as $message) : ?> <li class="err__item"><?= $message ?></li>

		<? endforeach ?>
	</ul>
<? endif ?>

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