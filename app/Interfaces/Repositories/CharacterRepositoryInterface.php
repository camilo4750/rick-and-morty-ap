<?php

namespace App\Interfaces\Repositories;

use App\Dto\Character\CharacterDto;
use App\Dto\Character\CharacterUpdateDto;
use Illuminate\Support\Collection;

interface CharacterRepositoryInterface
{
    public function getAll(): Collection; 
    public function store(CharacterDto $dto): static;
    public function existsById(int $id): bool;
    public function update(CharacterUpdateDto $dto): static;
}