<?php

namespace OpenVpnManager\Middleware;

/**
* 
*/
class AuthenticationMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next)
	{
		if (!$this->container->authentication->check()){
			$this->getContainer()->flash->addMessage('error', 'Please Sign in before doing that!');
			return $response->withRedirect($this->getContainer()->router->pathFor('authentication.signin'));
		}

		$response = $next($request, $response);

		return $response;	
	}
}