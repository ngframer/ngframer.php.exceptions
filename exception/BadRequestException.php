<?php

namespace NGFramer\NGFramerPHPBase\exceptions;

use Exception;

class BadRequestException extends Exception
{
	protected $code = 400;
	protected $message = "The request is invalid.";
}
