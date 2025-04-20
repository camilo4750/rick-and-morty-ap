<?php

namespace App\Repositories\Character;

use App\Entities\Character\CharacterEntity;
use App\Interfaces\Repositories\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function getAll()
    {
        $characters = CharacterEntity::query()->get();

        return $characters;
    }
}