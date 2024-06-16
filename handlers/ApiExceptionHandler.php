<?php

namespace NGFramer\NGFramerPHPExceptions\handlers;

use NGFramer\NGFramerPHPExceptions\handlers\supportive\_BaseHandler;
use Throwable;

class ApiExceptionHandler extends _BaseHandler
{
    public function handle(Throwable $exception): void
    {
        // Use the parent method to handle the exception.
        parent::handle($exception);
        // Set the status code and echo the response.
        header('Content-Type: application/json');
        http_response_code($this->response['statusCode']);
        echo json_encode($this->response);
    }
}
