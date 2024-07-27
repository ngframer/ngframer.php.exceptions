<?php
namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;
use Throwable;

class DbServicesException extends _BaseException
{
    // Constructor of this class.
    public function __construct($message, $code = 0, ?Throwable $throwable = null, int $statusCode = 500, array $details = [])
    {
        // Call the parent constructor for exception.
        parent::__construct($message, $code, $throwable, $statusCode, $details);
    }
}
