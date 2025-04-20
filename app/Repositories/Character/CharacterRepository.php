<?php

namespace App\Repositories\Character;

use App\Dto\Character\CharacterDto;
use App\Dto\Character\CharacterUpdateDto;
use App\Entities\Character\CharacterEntity;
use App\Interfaces\Repositories\CharacterRepositoryInterface;
use Illuminate\Support\Collection;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function getAll(): Collection
    {
        $characters = CharacterEntity::query()
            ->orderBy('id', 'asc')
            ->get();

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

    public function existsById(int $id): bool
    {
        return CharacterEntity::query()->where('id', $id)->exists();
    }

    public function update(CharacterUpdateDto $dto): static
    {
        CharacterEntity::query()
            ->where('id', $dto->id)
            ->update([
                'status' => $dto->status,
                'species' => $dto->species,
                'type' => $dto->type,
                'gender' => $dto->gender,
            ]);

        return $this;
    }
}

