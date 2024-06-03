<?php

namespace NGFramer\NGFramerPHPExceptions\handlers;

use NGFramer\NGFramerPHPExceptions\exceptions\SqlBuilderException;
use NGFramer\NGFramerPHPExceptions\handlers\supportive\SourceTrait;
use Throwable;

class SqlBuilderExceptionHandler
{
    // Traits for the SqlBuilderExceptionHandler.
    use SourceTrait;

    // Handle the exception, handle function.
    public static function handle(Throwable $exception): void
    {
        // Get the message, statusCode, and also the details.
        $message = $exception->getMessage();
        $code = $exception->getCode();
        $statusCode = ($exception instanceof SqlBuilderException) ? $exception->getStatusCode() : 500;
        $details = ($exception instanceof SqlBuilderException) ? $exception->getDetails() : [];

        // Use the passed backtrace if available.
        $source = isset($details['backtrace']) ? self::getSource($details['backtrace']) : null;

        // Define the response to throw as method of error handling.
        $response = [
            'success' => false,
            'status_code' => $statusCode,
            'response' => [
                'error_type' => $details['error_type'] ?? $details[0] ?? 'UNDEFINED',
                'error_code' => $details['error_code'] ?? $details[1] ?? 'UNDEFINED',
                'error_message' => $message,
            ]
        ];

        // If source is available, add it to the response.
        if (APPMODE === 'development') {
            $response['source'] = $source;
        }

        // Set the status code and echo the response.
        http_response_code($statusCode);
        echo json_encode($response);

        // Exit the application.
        exit;
    }
}
