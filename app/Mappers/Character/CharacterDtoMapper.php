<?php

namespace  App\Mappers\Character;

use App\Dto\Character\CharacterDto;
use App\Mappers\BaseMapper;

class CharacterDtoMapper extends BaseMapper
{
    protected function getNewDto(): CharacterDto
    {
        return new CharacterDto();
    }

    public function createFromObject(array $character): CharacterDto
    {
        $dto = new CharacterDto();
        $dto->name = $character['name'];
        $dto->status = $character['status'];
        $dto->species = $character['species'];
        $dto->type = $character['type'];
        $dto->gender = $character['gender'];
        $dto->image = $character['image'];
        $dto->origin = json_encode($character['origin']);
        $dto->location = json_encode($character['location']);
        return $dto;
    }
}
