<?php
namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Exception;

class SqlBuilderException extends Exception
{
    protected $statusCode;
    protected $errorDetails;

  
    public function __construct($message, $statusCode = 500, $errorDetails = [])
    {
        // Call the parent constructor for exception.
        parent::__construct($message);

        // Get the status code and update it.
        $this->statusCode = $statusCode;

        // Get the error details and update it.
        // We check if it has been set, as this class is also used by another class, and they can pass the backtrace directly.
        $errorDetails['backtrace'] = $errorDetails['backtrace'] ?? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $this->errorDetails = $errorDetails;
    }

  
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

  
    public function getErrorDetails(): array
    {
        return $this->errorDetails;
    }
}
