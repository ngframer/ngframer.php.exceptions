<?php

namespace NGFramer\NGFramerPHPExceptions\handlers;

use Throwable;
use NGFramer\NGFramerPHPExceptions\exceptions\SqlBuilderException;
use NGFramer\NGFramerPHPExceptions\handlers\supportive\SourceTrait;

class SqlBuilderExceptionHandler
{
    // Traits used in this class.
    use SourceTrait;


    // Main handler function for the SqlBuilderException.
    public static function handle(Throwable $exception)
    {
        // Get the message, statusCode, and also the errorDetails.
        $errorMessage = $exception->getMessage();
        $statusCode = ($exception instanceof SqlBuilderException) ? $exception->getStatusCode() : 500;
        $errorDetails = ($exception instanceof SqlBuilderException) ? $exception->getErrorDetails() : [];

        // Use the passed backtrace if available.
        $source = isset($errorDetails['backtrace']) ? self::getSource($errorDetails['backtrace']) : null;

        http_response_code($statusCode);
        echo json_encode(
            [
                'success' => false,
                'status_code' => $statusCode,
                'response' =>
                    [
                        'error_type' => $errorDetails['error_type'] ?? $errorDetails[0] ?? 'UNDEFINED',
                        'error_code' => $errorDetails['error_code'] ?? $errorDetails[1] ?? 'UNDEFINED',
                        'error_message' => $errorMessage,
                    ],
                'source' => $source
            ]
        );
        exit;
    }
}
