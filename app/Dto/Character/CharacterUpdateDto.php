<?php

namespace App\Dto\Character;

use App\Dto\BaseDto;

class CharacterUpdateDto extends BaseDto
{
    public int $id;
    public string $status;
    public string $species;
    public ?string $type;
    public string $gender;
}