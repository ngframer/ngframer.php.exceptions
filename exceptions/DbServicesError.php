<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseError;

class DbServicesError extends _BaseError
{
    public function convertToException($code, $message, string $file, int $line, array $context = []): void
    {
        // Throw the exception (ApiError).
        throw new DbServicesException($message, $code, null, 500, []);
    }
}
