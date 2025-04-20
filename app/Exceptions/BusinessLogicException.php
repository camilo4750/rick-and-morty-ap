<?php

namespace App\Exceptions;

class BusinessLogicException extends BaseException
{
    protected $message = 'Inconsistency in business rule.';
    protected $code = 422;
    protected array $errors = [];
}
