<?php

namespace NGFramer\NGFramerPHPExceptions\renderer;

use NGFramer\NGFramerPHPExceptions\renderer\supportive\_BaseRenderer;
use Throwable;

class ApiExceptionRenderer extends _BaseRenderer
{
    public function render(Throwable $exception): void
    {
        // Use the parent method to handle the exception.
        parent::render($exception);

        // Set the status code and echo the response.
        header('Content-Type: application/json');
        http_response_code($this->response['statusCode']);
        echo json_encode($this->response);

        // Exit the script.
        exit();
    }
}
