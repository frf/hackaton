<?php

namespace OpenVpnManager\Controllers\Authentication;
use OpenVpnManager\Controllers\Controller;
use OpenVpnManager\Models\User;
use Respect\Validation\Validator;
/**
* 
*/
class AuthenticationController extends Controller
{
	
	public function getSignUp($request, $response){
		return $this->getView()->render($response, 'Authentication/signup.twig');
	}

	public function postSignUp($request, $response){

		$validation = $this->getValidator()->validate($request, [
			'name' 		=> Validator::notEmpty()->alpha(),
			'email' 	=> Validator::noWhitespace()->notEmpty()->email()->emailAvailable(),
			'password' 	=> Validator::noWhitespace()->notEmpty(),
		]);

		if ($validation->failed()){
			return $response->withRedirect($this->getRouter()->pathFor('authentication.signup'));
		}

		$user = User::create([
			'name' 		=> $request->getParam('name'),
			'email' 	=> $request->getParam('email'),
			'password' 	=> password_hash($request->getParam('password'), PASSWORD_DEFAULT, ['cost' => 10]) ,
		]);

		$this->getFlash()->addMessage('info', 'You have been signed up');

		$this->getContainer()->authentication->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

		return $response->withRedirect($this->getRouter()->pathFor('home'));
	}


	public function getSignIn($request, $response){
		return $this->getView()->render($response, 'authentication/signIn.twig');
	}

	public function getSignOut($request, $response){
		$this->getContainer()->authentication->logout();
		return $response->withRedirect($this->getRouter()->pathFor('home'));
	}

	public function postSignIn($request, $response){

		$validation = $this->getValidator()->validate($request, [
			'email' 	=> Validator::noWhitespace()->notEmpty()->email(),
			'password' 	=> Validator::notEmpty(),
		]);

		$authentication = $this->getContainer()->authentication->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

		if (!$authentication) {
			$this->getFlash()->addMessage('error', 'Cold not sign you in with those details.');
			return $response->withRedirect($this->getRouter()->pathFor('authentication.signin'));
		}

		return $response->withRedirect($this->getRouter()->pathFor('home'));			

	}

}