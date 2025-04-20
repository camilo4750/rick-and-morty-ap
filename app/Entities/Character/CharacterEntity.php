<?php 

namespace App\Entities\Character;

use App\Entities\BaseEntity;
use Database\Factories\CharacterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CharacterEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'characters';

    protected static function newFactory()
    {
        return CharacterFactory::new();
    }
}