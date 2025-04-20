<?php

namespace App\Services\Character;

use App\Exceptions\Character\CharacterNotFoundException;
use App\Interfaces\Repositories\CharacterRepositoryInterface;
use App\Interfaces\Services\CharacterServiceInterface;
use App\Mappers\Character\CharacterDtoMapper;
use App\Mappers\Character\CharacterUpdateDtoMapper as CharacterCharacterUpdateDtoMapper;
use App\Mappers\Character\CharacterViewDtoMapper;
use Illuminate\Http\Request;

class CharacterService implements CharacterServiceInterface
{
    private $characterRepo;

    public function __construct(CharacterRepositoryInterface $characterRepo)
    {
        $this->characterRepo = $characterRepo;
    }

    public function getAll(): array
    {
        $characters = $this->characterRepo->getAll();
        return (new CharacterViewDtoMapper())->createCollectionFromDbRecords($characters);
    }

    public function store(Request $request): void
    {
        $characters = $request->input('characters');
        throw_if(
            empty($characters),
            new CharacterNotFoundException(message: 'No se encontraron personajes'),
        );

        foreach ($characters as $character) {
            $dto = (new CharacterDtoMapper())->createFromObject($character);
            $this->characterRepo->store($dto);
        }
    }

    public function update(Request $request)
    {
        $character = $request->input('character');

        $existsCharacter = $this->characterRepo->existsById($character['id']);
        throw_if(
            !$existsCharacter,
            new CharacterNotFoundException(),
        );

        $dto = (new CharacterCharacterUpdateDtoMapper())->createFromRequest($character);
        $this->characterRepo->update($dto);
    }
}

