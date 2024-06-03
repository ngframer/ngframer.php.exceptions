<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;

class ServerErrorException extends _BaseException
{
    // Updated the values of this class.
    protected $message = "Server Error";
    // TODO: Change the code based on the documentation in the upcoming time.
    protected $code = 0;
    protected int $statusCode = 500;
    protected array $details = [];
}
