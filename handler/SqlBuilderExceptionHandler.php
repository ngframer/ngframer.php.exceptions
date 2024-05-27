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
        $source = self::getSource();

        http_response_code($statusCode);
        echo json_encode(
            [
                'success' => false,
                'status_code' => $statusCode,
                'source' => $source,
                'response' =>
                    [
                        'error_code' => $errorDetails['error_code'] ?? $errorDetails[0] ?? 'UNDEFINED',
                        'error_type' => $errorDetails['error_type'] ?? $errorDetails[1] ?? 'UNDEFINED',
                        'error_message' => $errorMessage,
                    ]
            ]
        );
        exit;
    }

    public static function getSource(): array
    {
        // Get the trace.
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        // Check if called from within a class method
        $info = $trace[1];
        $namespace = '';
        $class = $info['class'] ?? '';
        $function = $info['function'] ?? '';
        $line = $trace[0]['line'] ?? '';

        // Extract namespace if class name includes it
        if ($class) {
            $namespaceParts = explode('\\', $class);
            $class = array_pop($namespaceParts);
            $namespace = implode('\\', $namespaceParts);
        }

        return [
            'namespace' => $namespace,
            'class' => $class,
            'function' => $function,
            'line' => $line
        ];
    }

}
