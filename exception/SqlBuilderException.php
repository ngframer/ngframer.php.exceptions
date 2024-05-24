<?php
namespace NGFramer\NGFramerPHPSQLBuilder;

use Exception;

class SqlException extends Exception
{
    protected $statusCode;
    protected $errorDetails;
    protected $source;

  
    public function __construct($message, $statusCode = 500, $errorDetails = [], $source = null)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->errorDetails = $errorDetails;
        $this->source = $source;
    }

  
    public function getStatusCode()
    {
        return $this->statusCode;
    }

  
    public function getErrorDetails()
    {
        return $this->errorDetails;
    }

  
    public function getSource(): mixed
    {
        return $this->source;
    }
}
