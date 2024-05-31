<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Error;

class SqlBuilderError extends Error
{
    public static function convertToException(int $errorCode, string $errorMessage, string $errorFile, int $errorLine): void
    {
        // Error type and code defined.
        $errorDetails['error_type'] = error_get_last()['type'] ?? 'UNDEFINED';
        $errorDetails['error_code'] = $errorCode;

        // Error file and line defined for debugging.
        $errorDetails['file'] = $errorFile;
        $errorDetails['line'] = $errorLine;

        // Error backtrace defined for debugging.
        $errorDetails['backtrace'] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // Throw the exception (SqlBuilderException).
        throw new SqlBuilderException($errorMessage, 500, $errorDetails);
    }
}