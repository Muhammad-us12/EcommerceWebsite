<?php

namespace Tests\Feature\Controllers;

use App\Enums\UserRoles;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testDisplayAllProduct(): void
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        Product::factory(10)->create();

        $response = $this->actingAs($user)->get('/admin/product');

        $response->assertOk();
    }

    public function testCanCreateProduct()
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $category = Category::factory()->create();
        $subCategory = Category::factory(['parent_id' => $category->id])->create();
        $brand = Brand::factory()->create();
        $thumbnailImage = UploadedFile::fake()->image('thumbnail.jpg');
        $galleryImages = [
            UploadedFile::fake()->image('gallery1.jpg'),
            UploadedFile::fake()->image('gallery2.jpg'),
        ];

        $payload = [
            'name' => fake()->name,
            'description' => fake()->text(),
            'category_id' => $category->id,
            'subcategory_id' => $subCategory->id,
            'brand_id' => $brand->id,
            'price' => fake()->numberBetween(400, 500),
            'cost_price' => fake()->numberBetween(200, 300),
            'quantity' => fake()->numberBetween(1, 10),
            'security_deposit' => fake()->numberBetween(100, 300),
            'thumbnail' => $thumbnailImage,
            'gallery' => $galleryImages,
        ];

        $response = $this->actingAs($user)->post('/admin/product/store', $payload);

        $this->assertDatabaseHas('products', [
            'name' => $payload['name'],
            'description' => $payload['description'],
            'category_id' => $payload['category_id'],
            'subcategory_id' => $payload['subcategory_id'],
            'brand_id' => $payload['brand_id'],
            'price' => $payload['price'],
            'quantity' => $payload['quantity'],
            'security_deposit' => $payload['security_deposit'],
            'user_id' => $user->id,
        ]);

        $product = Product::where('name', $payload['name'])->first();
        $this->assertTrue($product->hasMedia('image'));
    }

    public function testAddProductGallery()
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $product = Product::factory()->create();

        $galleryImages = [
            UploadedFile::fake()->image('gallery1.jpg'),
            UploadedFile::fake()->image('gallery2.jpg'),
        ];

        $payload = [
            'gallery' => $galleryImages,
        ];

        $response = $this->actingAs($user)->post("/admin/product/{$product->id}/gallery", $payload);

        $this->assertCount(2, $product->getMedia('gallery'));
    }

    public function testCanUpdateProduct()
    {
        $user = User::factory(['role' => UserRoles::ADMIN->value])->create();
        $category = Category::factory()->create();
        $subCategory = Category::factory(['parent_id' => $category->id])->create();
        $brand = Brand::factory()->create();
        $product = Product::factory()->create();

        $payload = [
            'product_id' => $product->id,
            'name' => fake()->name(),
            'description' => fake()->text(),
            'category_id' => $category->id,
            'subcategory_id' => $subCategory->id,
            'brand_id' => $brand->id,
            'price' => fake()->numberBetween(100, 500),
            'quantity' => fake()->numberBetween(1, 10),
            'security_deposit' => fake()->numberBetween(100, 300),
        ];

        $response = $this->actingAs($user)->post('/admin/product/update', $payload);

        $this->assertDatabaseHas('products', [
            'name' => $payload['name'],
            'description' => $payload['description'],
            'category_id' => $payload['category_id'],
            'subcategory_id' => $payload['subcategory_id'],
            'brand_id' => $payload['brand_id'],
            'price' => $payload['price'],
            'quantity' => $payload['quantity'],
            'security_deposit' => $payload['security_deposit'],
        ]);
    }

    // public function testCanDeleteProduct()
    // {
    //     $product = Product::factory()->create();

    //     $response = $this->actingAs($user)->get("/products/{$product->id}");

    //     $response->assertRedirect('/products');
    //     $this->assertDatabaseMissing('products', ['id' => $product->id]);
    // }
}
