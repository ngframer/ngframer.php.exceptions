<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions\supportive;

trait StatusCodeTrait
{
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
