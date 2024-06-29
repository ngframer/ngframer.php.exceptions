<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions\supportive;

Trait DetailsTrait
{
    public function getDetails(): array
    {
        return $this->details;
    }

}
