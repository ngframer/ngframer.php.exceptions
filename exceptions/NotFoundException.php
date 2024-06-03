<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;

class NotFoundException extends _BaseException
{
    // Updated the values of this class.
	protected $message = "The content you are looking for could not be found.";
	protected $code = 0;
	protected int $statusCode = 404;
    protected array $details = [];
}