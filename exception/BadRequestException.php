<?php

namespace NGFramer\NGFramerPHPException\exception;

use Exception;

class BadRequestException extends Exception
{
	protected $code = 400;
	protected $message = "The request is invalid.";
}
