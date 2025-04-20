<?php

namespace App\Exceptions\Character;

use App\Exceptions\BusinessLogicException;

class CharacterNotFoundException extends BusinessLogicException
{
    protected $message = 'Personaje no encontrado';
    protected $code = 404;

    protected array $errors = [];
}