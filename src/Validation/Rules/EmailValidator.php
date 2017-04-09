<?php

namespace Thinkific\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Thinkific\Models\User;

class EmailValidator extends AbstractRule
{
	public function validate($input){
        return filter_var($input, FILTER_VALIDATE_EMAIL);
	}
}