<?php

namespace App\Exceptions;

use App\Exceptions\Throwable;

class BaseException extends \Exception
{
    protected $message = '';
    protected $code = 0;
    protected array $errors;

    public function __construct(array $errors = [], string|null $message = null, int $code = 0, ?\Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message ?? $this->message, $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
