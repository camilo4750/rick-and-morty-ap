<?php

namespace App\Exceptions;

class ApplicationLogicException extends BaseException
{
    protected $message = 'Inconsistency in execution.';
    protected $code = 500;
    protected array $errors = [];
}
