<?php

namespace App\Interfaces\Services;

use Illuminate\Http\Request;

interface CharacterServiceInterface 
{
    public function getAll();
    public function store(Request $request);
}
