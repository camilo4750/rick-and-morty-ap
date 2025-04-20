<?php

namespace App\Repositories\Character;

use App\Dto\Character\CharacterDto;
use App\Entities\Character\CharacterEntity;
use App\Interfaces\Repositories\CharacterRepositoryInterface;
use Illuminate\Support\Collection;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function getAll(): Collection
    {
        $characters = CharacterEntity::query()->get();

        return $characters;
    }

    public function store(CharacterDto $dto): static
    {
        CharacterEntity::query()->insert([
            'name' => $dto->name,
            'status' => $dto->status,
            'species' => $dto->species,
            'type' => $dto->type,
            'gender' => $dto->gender,
            'image' => $dto->image,
            'origin' => $dto->origin,
            'location' => $dto->location,
            'created_at' => 'now()',
        ]);

        return $this;
    }
}
