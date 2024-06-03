<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions\supportive;

Trait DetailsTrait
{
    protected function getDetails(): array
    {
        return $this->details;
    }

}