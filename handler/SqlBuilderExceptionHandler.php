<?php

namespace NGFramer\NGFramerPHPException\handler;

use Exception;
use NGFramer\NGFramerPHPException\exception\SqlBuilderException;

class SqlBuilderExceptionHandler
{
    public static function handle(Exception $exception)
    {
        $errorMessage = $exception->getMessage();
        $statusCode = ($exception instanceof SqlBuilderException) ? $exception->getStatusCode() : 500;
        $errorDetails = ($exception instanceof SqlBuilderException) ? $exception->getErrorDetails() : [];
        $source = ($exception instanceof SqlBuilderException) ? $exception->getSource() : 'unidentified';

        http_response_code($statusCode);
        echo json_encode([
            [
                'status' => 'error',
                'status_code' => $statusCode,
                'source' => $source,
                'response' =>
                    [
                        'errorCode' => $errorDetails['errorCode'] ?? 'UNDEFINED',
                        'errorMessage' => $errorMessage,
                    ]
            ]
        ]);
        exit;
    }
}