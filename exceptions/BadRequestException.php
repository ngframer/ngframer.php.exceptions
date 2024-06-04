<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;
use Throwable;

class BadRequestException extends _BaseException
{
    // Updated the values of this class.
	protected $message = "The request is invalid.";
    // TODO: Change the code based on the documentation in the upcoming time.
	protected $code = 0;
    protected ?Throwable $previous = null;
    protected int $statusCode = 400;
    protected array $details = [];
}
