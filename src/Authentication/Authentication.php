<?php

namespace Thinkific\Authentication;
use Thinkific\Models\User;

/**
* 
*/
class Authentication
{
	public function attempt($email, $password){
		$user = User::where('email', $email)->first();

		if (!$user){
			return false;
		}

		if (password_verify($password, $user->password)){
			$_SESSION['user_id'] = $user->id;
			return true;
		};

		return false;
	}

	public function logout(){
		unset($_SESSION['user_id']);
	}

	public function check(){
		return isset($_SESSION['user_id']);
	}

	public function getUser(){
		$sessionUser = @$_SESSION['user_id'];
		return isset($sessionUser) ? User::find($sessionUser) : false;
	}

}