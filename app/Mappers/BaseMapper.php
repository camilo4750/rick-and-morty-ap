<?php

namespace App\Mappers;

use App\Dto\BaseDto;

abstract class BaseMapper
{
    protected BaseDto $dto;

    abstract protected function getNewDto():BaseDto;

    public function getDto():BaseDto{
        return $this->dto;
    }

    public function setNewDto():self{
        $this->dto= $this->getNewDto();
        return $this;
    }
}
