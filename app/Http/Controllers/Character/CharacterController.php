<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wrappers\ControllerWrapper;
use App\Interfaces\Services\CharacterServiceInterface;
use Illuminate\Http\JsonResponse;

class CharacterController extends Controller
{
    private $characterService;

    public function __construct(CharacterServiceInterface $characterService)
    {
        $this->characterService = $characterService;
    }

    public function getAll(): array|JsonResponse
    {
        return ControllerWrapper::execWithJsonSuccessResponse(function () {
            $characters = $this->characterService->getAll();
            return [
                "message" => "Lista de personajes",
                "data" => $characters,
            ];
        });
    }
}
