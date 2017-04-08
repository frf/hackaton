<?php

namespace OpenVpnManager\Middleware;

/**
* 
*/
class CsrfViewMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next)
	{

		$this->getContainer()->view->getEnvironment()->addGlobal('csrf', [
			'field'	=> '
				<input type="hidden" name="' . $this->getCsrf()->getTokenNameKey()  . '" value="' . $this->getCsrf()->getTokenName() . '">
				<input type="hidden" name="' . $this->getCsrf()->getTokenValueKey() . '" value="' . $this->getCsrf()->getTokenValue() . '">
			',
		]);

		$response = $next($request, $response);

		return $response;	
	}
}