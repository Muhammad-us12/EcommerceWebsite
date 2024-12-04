<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationControllerTest extends TestCase
{
    // use RefreshDatabase;
    public function testAddLocation(): void
    {
        $user = User::factory()->create();

        $payload = ['name' => fake()->name];
        $this->actingAs($user)->post('/add-location', $payload);
        $this->assertDatabaseHas('locations', [
            'name' => $payload['name']
        ]);
    }

    public function testUpdateLocation(): void
    {
        $user = User::factory()->create();
        $location = Location::factory()->create();

        $payload = ['name' => fake()->name, 'locationId' => $location->id];
        $this->actingAs($user)->post('/update-location', $payload);
        $this->assertDatabaseHas('locations', [
            'name' => $payload['name']
        ]);
    }
}
