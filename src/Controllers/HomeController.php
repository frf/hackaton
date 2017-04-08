<?php

namespace Thinkific\Controllers;
use Thinkific\Models\User;

/**
* 
*/
class HomeController extends Controller
{
	public function index($request,$response){
		return $this->getView()->render($response, 'home.twig');
	}	
}