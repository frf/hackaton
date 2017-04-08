<?php

namespace OpenVpnManager\Middleware;

/**
* 
*/
class OldInputMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next)
	{

		$oldSession = @$_SESSION['old'];
		$this->getContainer()->view->getEnvironment()->addGlobal('old', $oldSession);
		$_SESSION['old'] = $request->getParams();

		$response = $next($request, $response);

		return $response;	
	}
}