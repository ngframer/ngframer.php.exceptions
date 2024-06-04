<?php
namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;
use Throwable;

class SqlBuilderException extends _BaseException
{
    // Constructor of this class.
    public function __construct($message, $code = 0, ?Throwable $throwable = null, int $statusCode = 500, array $details = [])
    {
        // Firstly we go for backtrace.
        // Get the error details and update it.
        // We check if it has been set, as this class is also used by another class, and they can pass the backtrace directly.
        $details['backtrace'] = $details['backtrace'] ?? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // Call the parent constructor for exception.
        parent::__construct($message, $code, $throwable, $statusCode, $details);

    }
}
