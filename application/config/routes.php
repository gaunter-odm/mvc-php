<?php return [

	'' => [
		'controller' => 'main',
		'action' => 'index',
		'role' => 'guest'
	],

	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
		'role' => 'guest'
	],

	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout',
		'role' => 'guest'
	],

	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
		'role' => 'guest'
	],

	'resource/{folder}/{file}' => [
		'controller' => 'resource',
		'action' => 'file'
	],

	'info/succes' => [
		'controller' => 'info',
		'action' => 'succes',
		'role' => 'user'
	]

];
