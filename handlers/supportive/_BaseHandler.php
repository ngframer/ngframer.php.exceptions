<?php

namespace NGFramer\NGFramerPHPExceptions\handlers\supportive;

use app\config\ApplicationConfig;
use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;
use Throwable;

abstract class _BaseHandler
{
    // Variable used across this and other extending classes to get the responses.
    protected array $response;


    // Handle the exception, handle function.
    public function handle(Throwable $exception): void
    {
        // Get the statusCode and the details.
        $statusCode = ($exception instanceof _BaseException) ? $exception->getStatusCode() : 500;
        $details = ($exception instanceof _BaseException) ? $exception->getDetails() : [];

        // Operations on the file and line of error to show for errorSource as string.
        $joinString = " :";
        $errorSource = $exception->getFile() . $joinString . $exception->getLine();

        // Operations on the traces of error to show as string.
        $errorTrace = [];

        foreach ($exception->getTrace() as $indivTrace) {
            $file = $indivTrace['file'] ?? 'UnknownFile';
            $line = $indivTrace['line'] ?? 'UnknownLine';
            $function = $indivTrace['function'] ?? 'UnknownFunc';
            $args = isset($indivTrace['args']) ? json_encode($indivTrace['args']) : '[]';
            // Build the log from the data captured above.
            $errorTrace[] = $file . $joinString . $line . $joinString . $function . $joinString . $args;
        }


        // Define the response to throw as method of error handling.
        $response = [
            'success' => false,
            'statusCode' => $statusCode,
            'details' => [
                // Error code is the 2nd parameter of Exception ($code = 0).
                'errorCode' => $exception->getCode(),
                // Error type is defined by the user is string, defaults to .
                'errorType' => $details['errorType'] ?? 'undefined',
                // Error message is the 1st parameter of Exception ($message = "").
                'errorMessage' => $exception->getMessage()
            ]
        ];

        // Only available for the developer, data to debug.
        $appMode = ApplicationConfig::get('appMode');
        if ($appMode === 'development') {
            $response['details']['errorSource'] = $errorSource;
            $response['details']['errorTrace'] = $errorTrace;
            if (!empty($exception->getPrevious())) {
                $response['previous'] = $exception->getPrevious();
            }
        }

        // Save the response to the class base.
        $this->response = $response;
    }
}
