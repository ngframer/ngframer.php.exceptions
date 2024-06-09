<?php

namespace NGFramer\NGFramerPHPExceptions\handlers;

use app\config\ApplicationConfig;
use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;
use NGFramer\NGFramerPHPExceptions\handlers\supportive\SourceTrait;
use Throwable;

class ApiExceptionHandler
{
    // Traits for the ApiExceptionHandler.
    use SourceTrait;


    // Handle the exception, handle function.
    public static function handle(Throwable $exception): void
    {
        // Get the message, statusCode, and also the details.
        $message = $exception->getMessage();
        $code = $exception->getCode();
        $previous = $exception->getPrevious();
        $statusCode = ($exception instanceof _BaseException) ? $exception->getStatusCode() : 500;
        $details = ($exception instanceof _BaseException) ? $exception->getDetails() : [];

        // Use the passed backtrace if available.
        $source = isset($details['backtrace']) ? self::getSource($details['backtrace']) : null;

        // Define the response to throw as method of error handling.
        $response = [
            'success' => false,
            'status_code' => $statusCode,
            'response' => [
                'error_message' => $message,
                'error_code' => $code,
                'error_type' => $details['error_type'] ?? $details[0] ?? 'UNDEFINED',
            ]
        ];

        // If source is available, add it to the response.
        $appMode = ApplicationConfig::get('appMode');
        if ($appMode === 'development') {
            $response['source'] = $source;
            $response['previous'] = $previous;
        }

        // Set the status code and echo the response.
        http_response_code($statusCode);
        echo json_encode($response);

        // Exit the application.
        exit;
    }
}
