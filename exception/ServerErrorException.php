<?php

namespace NGFramer\NGFramerPHPException\exception;

use Exception;

class ServerErrorException extends Exception
{
    protected $code = 500;
    protected $message = "Server Error";
}
