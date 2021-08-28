<?php
function _config($conf)
{
	return require "application/config/$conf.php";
}
spl_autoload_register(function ($class) {
	$path = str_replace('\\', '/', $class . '.php');
	if (file_exists($path))
		require $path;
});


function print_error(string $error = '')
{
	foreach (_config('pdo_codes') as $code => $msg)
		if ($error == $code) {
			echo "<div class='msg'>$msg</div>";
			break;
		}
}
