<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

Trait DetailsTrait
{
    public function getDetails(): array
    {
        return $this->details;
    }

}
