<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Exception;

class ServerErrorException extends Exception
{
    protected $code = 500;
    protected $message = "Server Error";
}
