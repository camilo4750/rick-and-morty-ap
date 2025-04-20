<?php

namespace App\Services\Character;

use App\Exceptions\Character\CharacterNotFoundException;
use App\Interfaces\Repositories\CharacterRepositoryInterface;
use App\Interfaces\Services\CharacterServiceInterface;
use App\Mappers\Character\CharacterDtoMapper;
use App\Mappers\Character\CharacterViewDtoMapper;
use Illuminate\Http\Request;

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

    public function store(Request $request)
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
}
