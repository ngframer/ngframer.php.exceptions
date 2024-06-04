<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions\supportive;

use Exception;

class _BaseException extends Exception
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
    public function __construct($message = null, $code = 0, int $statusCode = 500, array $details = [])
    {
        // If any of the values are set, use it, else use default value.
        $message = $message ?? $this->message;
        $code = $code ?? $this->code;

        // Call the parent constructor for exception.
        parent::__construct($message, $code);

        // Set the status code and the details.
        $this->statusCode = $statusCode;
        $this->details = $details;
    }


    // We have used traits for more functionality in the exceptions.
}
