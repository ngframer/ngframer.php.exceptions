<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Error;

class BaseError extends Error
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
        $label = $this->getLabel($code);

        // Generate the error details.
        $details['errorCode'] = $code;
        $details['errorLabel'] = $this->getLabel($code);
        $details['errorMessage'] = $message;
        $details['errorSource'] = $file . ':' . $line;

        // Now prepare and throw an exception.
        Throw new ErrorException($message, $code, $label, null, 500, $details);
    }


    /**
     * Function that returns the type of error.
     *
     * @param $code
     * @return string
     */
    private function getLabel($code): string
    {
        switch ($code) {
            case E_ERROR:
                return 'error_error';
            case E_WARNING:
                return 'error_warning';
            case E_PARSE:
                return 'error_parse';
            case E_NOTICE:
                return 'error_notice';
            case E_CORE_ERROR:
                return 'error_core_error';
            case E_CORE_WARNING:
                return 'error_core_warning';
            case E_COMPILE_ERROR:
                return 'error_compile_error';
            case E_COMPILE_WARNING:
                return 'error_compile_warning';
            case E_USER_ERROR:
                return 'error_user_error';
            case E_USER_WARNING:
                return 'error_user_warning';
            case E_USER_NOTICE:
                return 'error_user_notice';
            case E_STRICT:
                return 'error_strict';
            case E_RECOVERABLE_ERROR:
                return 'error_recorable';
            case E_DEPRECATED:
                return 'error_deprecated';
            case E_USER_DEPRECATED:
                return 'error_user_deprecated';
            default:
                return 'error_unknown';
        }
    }
}