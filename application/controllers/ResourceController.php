<?php

namespace application\controllers;

class ResourceController
{
	public function __construct($params = [])
	{

		echo __METHOD__ . ' -- ' . __LINE__ . '<br>';
		debug($params);
	}

	public function fileAction()
	{
	}
}
