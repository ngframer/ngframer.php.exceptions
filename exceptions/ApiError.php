<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseError;

class ApiError extends _BaseError
{
    public function convertToException($code, $message, string $file, int $line, array $context = []): void
    {
        // Throw the exception (ApiError).
        throw new ApiException($message, $code, null, 500, []);
    }
}