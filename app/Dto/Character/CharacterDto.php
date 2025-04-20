<?php

namespace App\Dto\Character;

use App\Dto\BaseDto;

class CharacterDto extends BaseDto
{
    public string $name;
    public string $status;
    public string $species;
    public ?string $type;
    public string $gender;
    public string $image;
    public string $origin;
    public string $location;
}
