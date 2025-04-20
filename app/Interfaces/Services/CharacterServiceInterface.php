<?php

namespace App\Interfaces\Services;

use Illuminate\Http\Request;

interface CharacterServiceInterface 
{
    public function getAll(): array;
    public function store(Request $request): void;
    public function update(Request $request);
    
}
