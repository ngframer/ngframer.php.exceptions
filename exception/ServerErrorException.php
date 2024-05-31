<?php

namespace NGFramer\NGFramerPHPException\exception;

use Exception;

class ServerErrorException extends Exception
{
    protected $code = 403;
    protected $message = "Server Error";
}
