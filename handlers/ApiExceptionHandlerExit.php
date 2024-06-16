<?php

namespace NGFramer\NGFramerPHPExceptions\handlers;

use Throwable;

class ApiExceptionHandlerExit extends ApiExceptionHandler
{
    public function handle(Throwable $exception): void
    {
        // Handle the condition from the parent class ApiExceptionHandler.
        parent::handle($exception);
        // Now end the code by exiting, stops the PHP execution.
        exit();
    }

}