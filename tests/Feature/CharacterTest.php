<?php

namespace Tests\Feature;

use Tests\TestCase;

class CharacterTest extends TestCase
{
    /**
     * @test
     */
    public function is_get_all_working()
    {
        $response = $this->getJson(route('Character.getAll'));

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'data']);
    }
}