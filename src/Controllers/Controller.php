<?php

namespace Thinkific\Controllers;

use \Slim\Views\Twig as View;

/**
* 
*/
class Controller
{	
	private $container;

	public function __construct($container){
		$this->container = $container;
	}

    public function getView(){
        return $this->container->view;
    }

    public function setView($view){
        $this->container->view = $view;
    }

    public function getDB(){
		return $this->container->db;
	}

	public function getRouter(){
		return $this->container->router;
	}

	public function getValidator(){
		return $this->container->validator;
	}

	public function getCsrf(){
		return $this->container->csrf;
	}

	public function getAppName(){
		return 'Thinkific';
	}

	public function getContainer(){
		return $this->container;
	}

	public function getAthentication(){
		return $this->container->authentication;
	}

	public function getFlash(){
		return $this->container->flash;
	}
}