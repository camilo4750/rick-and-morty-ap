<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wrappers\ControllerWrapper;
use App\Interfaces\Services\CharacterServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function store(Request $request): array|JsonResponse
    {
        return ControllerWrapper::execWithJsonSuccessResponse(function () use ($request) {
            (new CharacterControllerValidateRules())
                ->validateStoreRequest($request);

            $this->characterService->store($request);

            return [
                "message" => "Tus personajes han sido guardados con éxito",
            ];
        });
    }

    public function update(Request $request): array|JsonResponse
    {
        return ControllerWrapper::execWithJsonSuccessResponse(function () use ($request) {
            (new CharacterControllerValidateRules())
                ->validateUpdateRequest($request);

            $character = $this->characterService->update($request);
            return [
                "message" => "Personaje Actualizado",
                "data" => $character,
            ];
        });
    }
}
