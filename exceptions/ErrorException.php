<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Throwable;

class ErrorException extends _BaseException
{
    public function __construct($message = null, $code = 0, ?Throwable $previous = null, int $statusCode = 500, array $details = [])
    {
        // Call the parent constructor for exception.
        parent::__construct($message, $code, $previous, $statusCode, $details);
    }
}