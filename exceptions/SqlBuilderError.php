<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Error;

class SqlBuilderError extends Error
{
    public static function convertToException($code, $message, string $file, int $line, array $context = []): void
    {
        // Error type and code defined.
        $details['error_type'] = error_get_last()['type'] ?? 'UNDEFINED';

        // Error file and line defined for debugging.
        $details['error_file'] = $file;
        $details['error_line'] = $line;
        $details['error_context'] = $context;

        // Error backtrace defined for debugging.
        $details['backtrace'] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // Throw the exception (SqlBuilderException).
        throw new SqlBuilderException($message, $code, null, 500, $details);
    }
}

// How to use this convert to exception to convert error to exception.
// The below line of code, converts the error to exception.
// Use where necessary or include in autoloader to load everywhere.

// ================================================================>
// set_error_handler([SqlBuilderError::class, 'convertToException']);
