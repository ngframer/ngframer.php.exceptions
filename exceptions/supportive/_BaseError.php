<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions\supportive;

use Error;

abstract class _BaseError extends Error
{
    // Function that converts the error to exception.
    public abstract function convertToException($code, $message, string $file, int $line, array $context = []): void;
    // How to use this convert to exception to convert error to exception.
    // The below line of code, converts the error to exception.
    // =====================================================================>
    // Generate the error details.
    // $details = self::generateDetails($file, $line, $context);
    // =====================================================================>
    // Now throw the error as an exception.
    // throw new NameException($message, $code, 0, 500, $details);

    // How to use this convert to exception to convert error to exception.
    // The below line of code, converts the error to exception.
    // We use the convert to exception, and pass all the error generated parameters to the function.
    // And, Use where necessary or include in autoloader to load everywhere.

    // ================================================================>
    // set_error_handler([NameError::class, 'convertToException']);


    protected static function generateDetails(string $file, int $line, array $context = []): array
    {
        // Error type and code defined.
        $details['error_type'] = error_get_last()['type'] ?? 'UNDEFINED';

        // Error file and line defined for debugging.
        $details['error_file'] = $file;
        $details['error_line'] = $line;
        $details['error_context'] = $context;

        // Error backtrace defined for debugging.
        $details['backtrace'] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // Set the error details in the class.
        return $details;
    }
}