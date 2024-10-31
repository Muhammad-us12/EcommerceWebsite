<?php

namespace Tests\Feature\Controllers;

use App\Enums\UserRoles;
use App\Models\ProductAttribute;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductAttributeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAddProductAttribute(): void
    {

        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $payload = [
            'name' => fake()->name,
        ];

        $response = $this->actingAs($user)->post('/admin/product-attribute/store', $payload);

        $this->assertDatabaseHas('product_attributes', [
            'name' => $payload['name'],
            'user_id' => $user->id,
        ]);
    }

    public function testDisplayAllProductAttribute(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $productAttribute = ProductAttribute::factory()->count(10)->create();

        $response = $this->actingAs($user)->get('/admin/product-attribute');

        $response->assertOk();
    }

    public function testUpdateProductAttribute(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $productAttribute = ProductAttribute::factory()->create();
        $payload = [
            'productAttributeId' => $productAttribute->id,
            'name' => fake()->name,
        ];

        $response = $this->actingAs($user)->post('/admin/product-attribute/update', $payload);

        $this->assertDatabaseHas('product_attributes', [
            'name' => $payload['name'],
            'user_id' => $user->id,
            'id' => $productAttribute->id,
        ]);
    }
}
