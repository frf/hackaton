<?php

namespace Thinkific\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Thinkific\Models\User;

class MatchesPassword extends AbstractRule
{

	protected $password;

	public function __construct($password){
		$this->password = $password;
	}

	public function validate($input){
		return password_verify($input, $this->password);
	}
}