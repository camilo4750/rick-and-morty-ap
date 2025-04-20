<?php 

namespace Database\Factories;

use App\Entities\Character\CharacterEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Entities\Character\CharacterEntity>
 */
class CharacterFactory extends Factory
{
     /**
     * @var string
     */
    protected $model = CharacterEntity::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
        ];
    }
}