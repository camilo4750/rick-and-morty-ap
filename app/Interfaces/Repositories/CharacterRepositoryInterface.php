<?php

namespace App\Interfaces\Repositories;

use App\Dto\Character\CharacterDto;
use Illuminate\Support\Collection;

interface CharacterRepositoryInterface
{
    public function getAll(): Collection; 
    public function store(CharacterDto $dto): static;
}