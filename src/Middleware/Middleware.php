<?php

namespace Thinkific\Middleware;


/**
* 
*/
class Middleware
{
	protected $container;

	function __construct($container)
	{
		$this->container = $container;
	}

	public function getContainer(){
		return $this->container;
	}

	public function getCsrf(){
		return $this->container->csrf;
	}
}