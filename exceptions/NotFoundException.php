<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Exception;

class NotFoundException extends Exception
{
	protected $code = 404;
	protected $message = "The content you are looking for could not be found.";
}
