<?php

namespace NGFramer\NGFramerPHPExceptions\Renderer\Supportive;

use Throwable;
use App\Config\ApplicationConfig;
use NGFramer\NGFramerPHPExceptions\Exceptions\BaseException;

abstract class BaseRenderer
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
        $statusCode = ($exception instanceof BaseException) ? $exception->getStatusCode() : 500;
        $details = ($exception instanceof BaseException) ? $exception->getDetails() : [];
        $label = ($exception instanceof BaseException) ? $exception->getLabel() : $details['errorLabel'] ?? 'undefined';

        // Operations on the file and line of error to show for errorSource as string.
        $joinString = " :";
        $errorSource = isset($details['errorSource']) ? $details['errorSource'] : $exception->getFile() . $joinString . $exception->getLine();

        // Operations on the traces of error to show as string.
        $errorTrace = [];

        // Set the exception in a variable to loop through the traces.
        // The main exception is being used in the end for the error message and code.
        $exceptionTemp = $exception->getPrevious();

        // Loop to get more trace of previous exceptions.
        while ($exceptionTemp !== null) {
            // Get the first trace of the exception.
            $trace = $exceptionTemp->getTrace()[0];
            // Now find where the error is occurring.
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
                $errorTrace[] = "<br>" . $this->buildTraceString($indivTrace);
            }
        }

        // Define the response to throw as a method of error handling.
        $response = [
            'success' => false,
            'statusCode' => $statusCode,
            'details' => [
                // The errorCode is the 2nd parameter of Exception ($code = 0).
                'errorCode' => $exception->getCode(),
                // The ErrorLabel is defined by the user, defaults to string and with the value 'undefined'.
                'errorLabel' => $label,
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

        // Set the response to the class base.
        // Need this for other renderer classes to use.
        $this->response = $response;
    }


    private function buildTraceString(array $trace): string
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
        error_log('Response => ' . json_encode($response, JSON_PRETTY_PRINT) . PHP_EOL);
    }
}
