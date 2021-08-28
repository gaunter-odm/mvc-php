<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><? echo $title ?></title>
</head>

<body>
	<ul>
		<?php

		$arr = _config("routes");

		foreach ($arr as $key => $value) {
			echo '<li><a href="http://mvc.local/' . $key  . '">' . $value['action'] . '</a></li>';
		}

		?>
	</ul>

	<style>
		body {
			font-family: arial, tahoma, sans-serif;
			width: 100vw;
		}

		ul,
		li {
			margin: 0;
			list-style: none;
		}

		ul {
			display: flex;
			margin-bottom: 100px;
		}

		li {
			margin-right: 20px;
		}

		a {
			text-decoration: none;
			font-size: 20px;
			color: #000;
			transition: .2s;
		}

		a:hover {
			color: red;
		}

		a::first-letter {
			text-transform: uppercase;
		}

		.msg {
			display: inline-block;
			padding: 5px 20px;
			border-radius: 3px;
			border: 1px solid #2e2e2e;
			margin: 0 auto 40px;
		}
	</style>
	<? echo $content; ?>
</body>

</html>