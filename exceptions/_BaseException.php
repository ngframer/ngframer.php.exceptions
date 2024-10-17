<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Exception;
use Throwable;

abstract class _BaseException extends Exception
{
    // Traits to use in this class.
    use StatusCodeTrait;
    use DetailsTrait;


    // Properties of the exception.
    protected $message;
    protected $code;
    protected int $statusCode;
    protected array $details;


    // Constructor of the exception.
    public function __construct($message = null, $code = 0, ?Throwable $previous = null, int $statusCode = 500, array $details = [])
    {
        // If any of the values are set, use it, else use default value.
        $message = $message ?? $this->message;
        $code = $code ?? $this->code;

        // Call the parent constructor for exception.
        parent::__construct($message, $code, $previous);

        // Set the status code and the details.
        $this->statusCode = $statusCode;
        $this->details = $details;
        // If in case, the error type has not been defined.
        if (empty($this->details) or !isset($this->details['errorType'])) {
            $this->details['errorType'] = 'undefined';
        }
    }


    // We have used traits for more functionality in the exceptions.
}
