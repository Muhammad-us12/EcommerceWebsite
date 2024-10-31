<?php

namespace Tests\Feature\Controllers;

use App\Enums\UserRoles;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAddBrand(): void
    {

        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $payload = [
            'name' => fake()->name,
        ];

        $response = $this->actingAs($user)->post('/admin/brand/store', $payload);

        $this->assertDatabaseHas('brands', [
            'name' => $payload['name'],
            'user_id' => $user->id,
        ]);
    }

    public function testDisplayAllBrand(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $brand = Brand::factory()->count(10)->create();

        $response = $this->actingAs($user)->get('/admin/brand');

        $response->assertOk();
    }

    public function testUpdateBrand(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $brand = Brand::factory()->create();
        $payload = [
            'brandId' => $brand->id,
            'name' => fake()->name,
        ];

        $response = $this->actingAs($user)->post('/admin/brand/update', $payload);

        $this->assertDatabaseHas('brands', [
            'name' => $payload['name'],
            'user_id' => $user->id,
            'id' => $brand->id,
        ]);
    }
}
