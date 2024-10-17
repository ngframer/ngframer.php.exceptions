<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Error;

abstract class _BaseError extends Error
{
    // Function that converts the error to exception.
    public abstract function convertToException($code, $message, string $file, int $line, array $context = []): void;
    // How to use this convert to exception to convert error to exception.
    // The below line of code converts the error to exception.
    // =====================================================================>
    // Generate the error details.
    // $details = self::generateDetails($file, $line, $context);
    // =====================================================================>
    // Now throw the error as an exception.
    // Throw new NameException($message, $code, 0, 500, $details);

    // How to use this convert to exception to convert error to exception.
    // The below line of code converts the error to exception.
    // We use the convertToException function and pass all the error-generated parameters to the function.
    // And, Use where necessary or include in autoloader to load everywhere.

    // ================================================================>
    // set_error_handler([NameError::class, 'convertToException']);
}