<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use NGFramer\NGFramerPHPExceptions\exceptions\supportive\_BaseException;
use Throwable;

class ForbiddenException extends _BaseException
{
    // Updated the values of this class.
    protected $message = "Permission denied. You don't have permission to access this page.";
    // TODO: Change the code based on the documentation in the upcoming time.
    protected $code = 0;
    protected ?Throwable $previous = null;
    protected int $statusCode = 403;
    protected array $details = [];
}
