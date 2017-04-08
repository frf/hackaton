<?php

namespace Thinkific\Middleware;

/**
* 
*/
class ValidationErrorsMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next)
	{
		$errors = @$_SESSION['errors'];
		$this->getContainer()->view->getEnvironment()->addGlobal('errors', $errors);
		unset($_SESSION['errors']);

		$response = $next($request, $response);

		return $response;	
	}
}