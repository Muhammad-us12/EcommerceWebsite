<?php

namespace Tests\Feature\Controllers;

use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAddCategory(): void
    {

        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $payload = [
            'name' => fake()->name,
        ];

        $response = $this->actingAs($user)->post('/admin/categories/store', $payload);

        $this->assertDatabaseHas('categories', [
            'name' => $payload['name'],
            'parent_id' => null,
            'user_id' => $user->id,
        ]);
    }

    public function testDisplayAllCategory(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $categories = Category::factory(['parent_id' => null])->count(10)->create();

        $response = $this->actingAs($user)->get('/admin/categories');

        $response->assertOk();
    }

    public function testUpdateCategory(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $category = Category::factory()->create();
        $payload = [
            'categoryId' => $category->id,
            'name' => fake()->name,
        ];

        $response = $this->actingAs($user)->post('/admin/categories/update', $payload);

        $this->assertDatabaseHas('categories', [
            'name' => $payload['name'],
            'parent_id' => null,
            'user_id' => $user->id,
            'id' => $category->id,
        ]);
    }

    public function testAddSubCategory(): void
    {

        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $category = Category::factory()->create();

        $payload = [
            'name' => fake()->name,
            'parent_id' => $category->id,
        ];

        $response = $this->actingAs($user)->post('/admin/categories/store', $payload);

        $this->assertDatabaseHas('categories', [
            'name' => $payload['name'],
            'parent_id' => $category->id,
            'user_id' => $user->id,
        ]);
    }

    public function testDisplayAllSubCategories(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $parentCategory = Category::factory(['parent_id' => null])->create();
        $categories = Category::factory(['parent_id' => $parentCategory->id])->count(10)->create();

        $response = $this->actingAs($user)->get('/admin/categories/sub-categories');

        $response->assertOk();
    }

    public function testUpdateCSubategory(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $parentCategory = Category::factory(['parent_id' => null])->create();
        $parentCategory1 = Category::factory(['parent_id' => null])->create();
        $category = Category::factory(['parent_id' => $parentCategory->id])->create();
        $payload = [
            'categoryId' => $category->id,
            'name' => fake()->name,
            'parent_id' => $parentCategory1->id,
        ];

        $response = $this->actingAs($user)->post('/admin/categories/update', $payload);

        $this->assertDatabaseHas('categories', [
            'name' => $payload['name'],
            'parent_id' => $parentCategory1->id,
            'user_id' => $user->id,
            'id' => $category->id,
        ]);
    }
}
