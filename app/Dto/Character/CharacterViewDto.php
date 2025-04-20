<?php

namespace App\Dto\Character;

use App\Dto\BaseDto;

class CharacterViewDto extends BaseDto
{
    public int $id;
    public string $name;
    public string $status;
    public string $species;
    public string $type;
    public string $gender;

    public string $image;

    public array $origin;
    public array $location;
    public string $createdAt;
    public string $updatedAt;
}
