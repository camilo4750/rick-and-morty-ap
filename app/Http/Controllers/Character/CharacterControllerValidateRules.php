<?php

namespace App\Http\Controllers\Character;

use Illuminate\Http\Request;

class CharacterControllerValidateRules
{
    public function validateStoreRequest(Request $request)
    {
        $rules = [
            'characters' => ['required', 'array', 'min:1'],
            'characters.*.name' => ['required', 'string'],
            'characters.*.status' => ['required', 'string'],
            'characters.*.species' => ['required', 'string'],
            'characters.*.type' => ['string'],
            'characters.*.gender' => ['required', 'string'],
            'characters.*.image' => ['required', 'string'],
            
            'characters.*.origin' => ['required', 'array'],
            'characters.*.origin.name' => ['required', 'string'],
            'characters.*.origin.url' => ['required', 'string'],

            'characters.*.location' => ['required', 'array'],
            'characters.*.location.name' => ['required', 'string'],
            'characters.*.location.url' => ['required', 'string'],
        ];
    }
}