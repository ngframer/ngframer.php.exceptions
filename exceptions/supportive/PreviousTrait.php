<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions\supportive;

use Throwable;

Trait PreviousTrait
{
    protected function getPrevious(): null|Throwable
    {
        return $this->previous;
    }

}