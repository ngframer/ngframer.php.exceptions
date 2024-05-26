<?php
namespace NGFramer\NGFramerPHPException\exception;

use Exception;

class SqlBuilderException extends Exception
{
    protected $statusCode;
    protected $errorDetails;
    protected $source;

  
    public function __construct($message, $statusCode = 500, $errorDetails = [])
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->errorDetails = $errorDetails;
    }

  
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

  
    public function getErrorDetails(): array
    {
        return $this->errorDetails;
    }

  
    public function getSource(): ?string
    {
        return $this->source;
    }
}
