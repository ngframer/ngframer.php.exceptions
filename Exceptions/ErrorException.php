<?php

namespace NGFramer\NGFramerPHPExceptions\Exceptions;

use Throwable;

class ErrorException extends BaseException
{
    public function __construct(string $message, int $code = 0, string $label = '', ?Throwable $previous = null, int $statusCode = 500, array $details = [])
    {
        // Call the parent constructor for exception.
        parent::__construct($message, $code, $label, $previous, $statusCode, $details);
    }
}