<?php

namespace Thinkific\Middleware;

/**
* 
*/
class GuestMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next)
	{

		if ($this->getContainer()->authentication->check()){
			return $response->withRedirect($this->getContainer()->router->pathFor('home'));
		}

		$response = $next($request, $response);

		return $response;	
	}
}