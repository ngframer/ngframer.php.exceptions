<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Error;

class _BaseError extends Error
{
    /**
     * Function that converts the error to exception.
     *
     * @param $code
     * @param $message
     * @param string $file
     * @param int $line
     * @param array $context
     * @throws ErrorException
     */
    public function convertToException($code, $message, string $file, int $line, array $context = []): void
    {
        // Get the type of error.
        $type = $this->getType($code);

        // Generate the error details.
        $details['errorCode'] = $code;
        $details['errorType'] = $type;
        $details['errorMessage'] = $message;
        $details['errorSource'] = $file . ':' . $line;

        // Now prepare and throw an exception.
        Throw new ErrorException($message, $code, null, 500, $details);
    }


    /**
     * Function that returns the type of error.
     *
     * @param $code
     * @return string
     */
    private function getType($code): string
    {
        switch ($code) {
            case E_ERROR:
                return 'E_ERROR';
            case E_WARNING:
                return 'E_WARNING';
            case E_PARSE:
                return 'E_PARSE';
            case E_NOTICE:
                return 'E_NOTICE';
            case E_CORE_ERROR:
                return 'E_CORE_ERROR';
            case E_CORE_WARNING:
                return 'E_CORE_WARNING';
            case E_COMPILE_ERROR:
                return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING:
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR:
                return 'E_USER_ERROR';
            case E_USER_WARNING:
                return 'E_USER_WARNING';
            case E_USER_NOTICE:
                return 'E_USER_NOTICE';
            case E_STRICT:
                return 'E_STRICT';
            case E_RECOVERABLE_ERROR:
                return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED:
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED:
                return 'E_USER_DEPRECATED';
            default:
                return 'UNKNOWN';
        }
    }
}