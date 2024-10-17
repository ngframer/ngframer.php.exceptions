<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

trait StatusCodeTrait
{
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
