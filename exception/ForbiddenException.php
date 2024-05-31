<?php

namespace NGFramer\NGFramerPHPException\exception;

use Exception;

class ForbiddenException extends Exception
{
    protected $code = 403;
    protected $message = "Permission denied. You don't have permission to access this page.";

}
