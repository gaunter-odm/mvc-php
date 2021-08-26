<?php

namespace application\core;

class Router
{
	protected $routs = [];
	protected $params = [];

	public function __construct()
	{
		echo "router";
	}

	public function add()
	{
	}
	public function match()
	{
	}
	public function run()
	{
		echo '<br/>start';
	}
}
