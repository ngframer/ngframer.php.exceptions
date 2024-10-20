<?php

namespace NGFramer\NGFramerPHPExceptions\renderer\supportive;

use app\config\ApplicationConfig;
use Exception;
use NGFramer\NGFramerPHPExceptions\exceptions\_BaseException;
use Throwable;

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
        $exceptionTemp = $exception;

        // Loop to get more trace of previous exceptions.
        while ($exceptionTemp->getPrevious() !== null) {
            $exceptionTemp = $exceptionTemp->getPrevious();
            $errorTrace[] = $exceptionTemp->getFile() . $joinString . $exceptionTemp->getLine();
        }

        // Reverse the array to get the correct order of the traces.
        $errorTrace = array_reverse($errorTrace);

        // Loop through the traces of the error.
        foreach ($exception->getTrace() as $indivTrace) {
            $file = $indivTrace['file'] ?? 'UnknownFile';
            $line = $indivTrace['line'] ?? 'UnknownLine';
            $function = $indivTrace['function'] ?? 'UnknownFunc';
            $args = isset($indivTrace['args']) ? json_encode($indivTrace['args']) : '[]';
            // Build the log from the data captured above.
            $errorTrace[] = $file . $joinString . $line . $joinString . $function . $joinString . $args;
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

        // Save the response to the class base.
        $this->response = $response;

        // Log the error and the response.
        $this->logError($exception, $response);
    }


    /**
     * Function to log the exception and the response.
     *
     * @param Throwable $exception
     * @param array $response
     */
    private function logError(Throwable $exception, array $response): void
    {
        // Form the log message.
        $dateTime = date('Y-m-d H:i:s');
        $errorMessage = $response['details']['errorMessage'];
        $errorSource = $response['details']['errorSource'];

        // Detailed log.
        $response = json_encode($this->response, JSON_PRETTY_PRINT);
        $exception = $exception->getTraceAsString();

        // Location to log the error.
        try {
            $location = ApplicationConfig::get('root') . '/logs/errors.log';
        } catch (Exception $exception) {
            $location = 'errors.log';
        }

        // Log the error and the response.
        error_log("[" . $dateTime . "] " . "Response => " . $response . PHP_EOL, 3, $location);
        error_log(PHP_EOL);
    }
}
