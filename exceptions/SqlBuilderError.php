<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseError;

class SqlBuilderError extends _BaseError
{
    public function convertToException($code, $message, string $file, int $line, array $context = []): void
    {
        // Call the parent's method.
        $details = parent::generateDetails($file, $line, $context);

        // Throw the exception (ApiError).
        throw new SqlBuilderException($message, $code, null, 500, $details);
    }
}