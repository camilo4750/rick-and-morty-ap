<?php

namespace  App\Mappers\Character;

use App\Dto\Character\CharacterViewDto;
use App\Mappers\BaseMapper;

class CharacterViewDtoMapper extends BaseMapper
{
    protected function getNewDto(): CharacterViewDto
    {
        return new CharacterViewDto();
    }

    public function createFromDbRecords(object $dbRecord): CharacterViewDto
    {
        $dto = $this->getNewDto();
        $dto->id = $dbRecord->id;
        $dto->name = $dbRecord->name;
        $dto->status = $dbRecord->status;
        $dto->species = $dbRecord->species;
        $dto->type = $dbRecord->type;
        $dto->gender = $dbRecord->gender;
        $dto->image = $dbRecord->image;
        $dto->origin = json_decode($dbRecord->origin, true);
        $dto->location = json_decode($dbRecord->location, true);
        $dto->createdAt = $dbRecord->created_at;
        $dto->updatedAt = $dbRecord->updated_at;
        return $dto;
    }

    public function createCollectionFromDbRecords(object $dbRecord): array
    {
        return $dbRecord->map(function ($character) {
            return $this->createFromDbRecords($character);
        })->all();
    }
}

