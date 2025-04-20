<?php

namespace App\Services\Character;

use App\Interfaces\Repositories\CharacterRepositoryInterface;
use App\Interfaces\Services\CharacterServiceInterface;
use App\Mappers\Character\CharacterViewDtoMapper;

class CharacterService implements CharacterServiceInterface
{
    private $characterRepo;

    public function __construct(CharacterRepositoryInterface $characterRepo)
    {
        $this->characterRepo = $characterRepo;
    }

    public function getAll()
    {
        $characters = $this->characterRepo->getAll();
        return (new CharacterViewDtoMapper())->createCollectionFromDbRecords($characters);
    }   
}
