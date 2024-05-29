<?php

namespace NGFramer\NGFramerPHPException\handler;

use Throwable;
use NGFramer\NGFramerPHPException\exception\SqlBuilderException;

class SqlBuilderExceptionHandler
{
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


    public static function getSource($backtrace = null): array
    {
        // Use the provided backtrace if available.
        if (empty($backtrace)) $traces = $backtrace;
        else $traces[] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        // Initialize the trace map.
        $traceMap = [];

        // Loop through to get the trace elements.
        foreach ($traces as $trace) {
            // Start joining the trace elements.
            $joiningString = $trace['type'] ?? ">>";
            $currentTrace = $trace['file'] . $joiningString ?? '';
            $currentTrace .= $trace['class'] . $joiningString ?? '';
            $currentTrace .= $trace['object'] . $joiningString ?? '';
            $currentTrace .= $trace['function'] . $joiningString ?? '';
            $currentTrace .= $trace['line'] . $joiningString ?? '';

            // Add the current trace to the trace map.
            $traceMap[] = $currentTrace;
        }

        // Return the trace collection
        return $traceMap;
    }
}
