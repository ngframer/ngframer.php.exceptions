<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseError;

class SqlServicesError extends _BaseError
{
    public function convertToException($code, $message, string $file, int $line, array $context = []): void
    {
        // Throw the exception (ApiError).
        throw new SqlServicesException($message, $code, null, 500, []);
    }
}
