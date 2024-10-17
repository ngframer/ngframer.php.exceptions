<?php

namespace NGFramer\NGFramerPHPExceptions\renderer;

use NGFramer\NGFramerPHPExceptions\renderer\supportive\_BaseRenderer;
use Throwable;

class CliExceptionRenderer extends _BaseRenderer
{
    public function render(Throwable $exception): void
    {
        // Use the parent method to handle the exception.
        parent::render($exception);

        // Set the status code.
        http_response_code($this->response['statusCode']);

        // Fetch the response information.
        $message = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $trace = $exception->getTraceAsString();

        // Echo the response.
        echo "Exception: {$message}\nIn {$file} on line {$line}\n\nTrace:\n{$trace}\n";

        // Exit the script.
        exit();
    }
}
