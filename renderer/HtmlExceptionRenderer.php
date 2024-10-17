<?php

namespace NGFramer\NGFramerPHPExceptions\renderer;

use NGFramer\NGFramerPHPExceptions\renderer\supportive\_BaseRenderer;
use Throwable;

class HtmlExceptionRenderer extends _BaseRenderer
{
    public function render(Throwable $exception): void
    {
        // Use the parent method to handle the exception.
        parent::render($exception);

        // Set the status code.
        http_response_code($this->response['statusCode']);

        // Echo the response.
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error</title>
        </head>
        <body>
            <h1>Error</h1>
            <p>Message: {$this->response['details']['errorMessage']}</p>
            <p>Code: {$this->response['details']['errorCode']}</p>
            <p>Type: {$this->response['details']['errorType']}</p>
            <p>Source: {$this->response['details']['errorSource']}</p>
            <p>Trace: {$this->response['details']['errorTrace']}</p>
        </body>
        </html>";

        // Exit the script.
        exit();
    }
}
