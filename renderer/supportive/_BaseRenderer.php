<?php

namespace NGFramer\NGFramerPHPExceptions\renderer\supportive;

use Throwable;
use Exception;
use app\config\ApplicationConfig;
use NGFramer\NGFramerPHPExceptions\exceptions\_BaseException;

abstract class _BaseRenderer
{
    /**
     * The final response (message) of the exception.
     *
     * @var array $response
     */
    protected array $response;


    /**
     * Handle the exception and save the response to the class base.
     *
     * @param Throwable $exception
     * @return void
     */
    public function render(Throwable $exception): void
    {
        // Get the statusCode and the details.
        $statusCode = ($exception instanceof _BaseException) ? $exception->getStatusCode() : 500;
        $details = ($exception instanceof _BaseException) ? $exception->getDetails() : [];

        // Operations on the file and line of error to show for errorSource as string.
        $joinString = " :";
        $errorSource = $exception->getFile() . $joinString . $exception->getLine();

        // Operations on the traces of error to show as string.
        $errorTrace = [];

        // Set the exception in a variable to loop through the traces.
        // The main exception is being used in the end for the error message and code.
        $exceptionTemp = $exception->getPrevious();

        // Loop to get more trace of previous exceptions.
        while ($exceptionTemp !== null) {
            // Get the first trace of the exception.
            $trace = $exceptionTemp->getTrace()[0];
            // Now find where the error is occuring.
            $stringTrace = $this->buildTraceString($trace);
            // Check if the trace already is in the errorTrace, else add it.
            if (!in_array($stringTrace, $errorTrace)) {
                $errorTrace[] = $stringTrace;
            }
            // Move to the next exception.
            $exceptionTemp = $exceptionTemp->getPrevious();
        }

        // Reverse the array to get the correct order of the traces.
        $errorTrace = array_reverse($errorTrace);


        // Start a counter to find the first trace.
        $exceptionTraceCounter = 0;
        // Loop through the traces of the error.
        foreach ($exception->getTrace() as $indivTrace) {
            // Check the counter to find the first trace.
            if ($exceptionTraceCounter === 0) {
                $errorTrace[] = $errorSource;
                $exceptionTraceCounter = 1;
            } else {
                $errorTrace[] = $this->buildTraceString($indivTrace);
            }
        }

        // Define the response to throw as a method of error handling.
        $response = [
            'success' => false,
            'statusCode' => $statusCode,
            'details' => [
                // The errorCode is the 2nd parameter of Exception ($code = 0).
                'errorCode' => $exception->getCode(),
                // The ErrorType is defined by the user, defaults to string and with the value 'undefined'.
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
        }

        // Log the error and the response.
        $this->logError($response);
    }


    private function buildTraceString(array $trace)
    {
        // Use the following joining string.
        $joinString = " :";
        // Fetch the following details.
        $file = $trace['file'] ?? 'UnknownFile';
        $line = $trace['line'] ?? 'UnknownLine';
        $function = $trace['function'] ?? 'UnknownFunc';
        $args = isset($trace['args']) ? json_encode($trace['args']) : '[]';
        // Build and return the log from the data captured above.
        return $file . $joinString . $line . $joinString . $function . $joinString . $args;
    }


    /**
     * Function to log the exception and the response.
     *
     * @param array $response
     */
    private function logError(array $response): void
    {
        // Log the error and the response.
        error_log('Response => ' . $response . PHP_EOL);
    }
}