<?php

namespace Thinkific\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Thinkific\Models\User;

class EmailAvailable extends AbstractRule
{
	public function validate($input){
		var_dump($input);
		return User::where('email', $input)->count() === 0;
	}
}