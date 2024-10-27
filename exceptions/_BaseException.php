<?php

namespace NGFramer\NGFramerPHPExceptions\exceptions;

use Exception;
use Throwable;

abstract class _BaseException extends Exception
{
    /**
     * The message of the exception.
     * @var string|null
     */
    protected $message;


    /**
     * The code of the exception.
     * @var int
     */
    protected $code;


    /**
     * The label of the exception.
     * @var string
     */
    protected string $label;


    /**
     * The status code of the exception.
     * @var int
     */
    protected int $statusCode;


    /**
     * The details of the exception.
     * @var array
     */
    protected array $details;


    /**
     * _BaseException constructor.
     *
     * @param string $message
     * @param int $code
     * @param string $label
     * @param Throwable|null $previous
     * @param int $statusCode
     * @param array $details
     */
    public function __construct($message = '', $code = 0, string $label = '', ?Throwable $previous = null, int $statusCode = 500, array $details = [])
    {
        // If any of the values are set, use it, else use the default value.
        $message = $message ?? $this->message;
        $code = $code ?? $this->code;

        // Update the values to the class scope.
        $this->message = $message;
        $this->code = $code;
        $this->label = $label;

        // Call the parent constructor for exception.
        parent::__construct($message, $code, $previous);

        // Set the status code and the details.
        $this->statusCode = $statusCode;
        $this->details = $details;

        // If in case, the error label has not been defined.
        if (empty($this->details) or !isset($this->details['errorLabel'])) {
            if (!empty($label)) {
                $this->details['errorLabel'] = $label;
            } else {
                $this->details['errorLabel'] = 'undefined';
            }
        }
    }


    /**
     * Function that returns the status code of the exception.
     *
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }


    /**
     * Function that returns the status code of the exception.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Function that returns the label of the exception.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
}