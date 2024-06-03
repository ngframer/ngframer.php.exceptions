<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions\supportive;

trait StatusCodeTrait
{
    protected function getStatusCode(): int
    {
        return $this->statusCode;
    }
}