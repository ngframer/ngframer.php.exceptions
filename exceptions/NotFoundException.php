<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;
use Throwable;

class NotFoundException extends _BaseException
{
    // Updated the values of this class.
	protected $message = "The content you are looking for could not be found.";
    // TODO: Change the code based on the documentation in the upcoming time.
	protected $code = 0;
    protected ?Throwable $previous = null;
    protected int $statusCode = 404;
    protected array $details = [];
}