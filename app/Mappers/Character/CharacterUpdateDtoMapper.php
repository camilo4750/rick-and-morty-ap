<?php

namespace App\Mappers\Character;

use App\Dto\Character\CharacterUpdateDto;
use App\Mappers\BaseMapper;

class CharacterUpdateDtoMapper extends BaseMapper
{
    protected function getNewDto(): CharacterUpdateDto
    {
        return new CharacterUpdateDto();
    }

    public function createFromRequest(array $character): CharacterUpdateDto
    {
        $dto = $this->getNewDto();
        $dto->id = $character['id'];
        $dto->status = $character['status'];
        $dto->species = $character['species'];
        $dto->type = $character['type'];
        $dto->gender = $character['gender'];
        return $dto;
    }
}