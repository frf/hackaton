<?php

namespace OpenVpnManager\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use OpenVpnManager\Models\User;

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