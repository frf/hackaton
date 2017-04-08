<?php

namespace Thinkific\Controllers\Authentication;

use Thinkific\Models\User;
use Thinkific\Controllers\Controller;
use Respect\Validation\Validator;

/**
* 
*/
class PasswordController extends Controller
{
	
	public function getChangePassword($request, $response)
	{
		return $this->getView()->render($response, 'Authentication/password.twig');
	}

	public function postChangePassword($request, $response)
	{

		$validation = $this->getValidator()->validate($request,[
			'password_old' => Validator::noWhitespace()->notEmpty()->matchesPassword($this->getContainer()->authentication->getUser()->password),
			'password' => Validator::noWhitespace()->notEmpty(),
		]);	

		if ($validation->failed()){
			return $response->withRedirect($this->getRouter()->pathFor('authentication.password.change'));
		}

		$this->getContainer()->authentication->getUser()->setPassword($request->getParam('password'));

		$this->getFlash()->addMessage('info', 'password updated!');

		return $response->withRedirect($this->getRouter()->pathFor('home'));
	}
}