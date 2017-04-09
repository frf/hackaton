<?php

namespace Thinkific\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
* 
*/
class EmailValidatorException extends ValidationException
{
	
	public static $defaultTemplates = [
		self::MODE_DEFAULT => [
			self::STANDARD => 'Email invalid.',
		],
	];

}