<?php

namespace Tests\Feature\Controllers;

use App\Enums\UserRoles;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendorOnBoardingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_vendor_creation_with_fake_data()
    {
        // Generate fake data for the vendor
        $vendor = User::factory(['role' => UserRoles::VENDOR->value])->create();

        $payload = [
            'user_id' => $vendor->id,
            'phone' => $this->faker->numerify('##########'), // 10-digit phone number
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'cnic' => $this->faker->numerify('#############'), // 13-digit CNIC
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'bank_account_number' => $this->faker->numerify('###############'), // 15-digit account number
            'bank_name' => $this->faker->company,
        ];

        // Perform POST request to store the vendor

        $response = $this->actingAs($vendor)->post('/vendor/on-boarding/save', $payload);

        // Verify the database has the fake data
        $this->assertDatabaseHas('vendors', [
            'user_id' => $vendor->id,
            'phone' => $payload['phone'],
            'bank_name' => $payload['bank_name'],
        ]);
    }

    public function test_vendor_update_with_fake_data()
    {

        $user = User::factory(['role' => UserRoles::VENDOR->value])->create();
        $vendor = Vendor::factory(['user_id' => $user->id])->create();
        dump($vendor->toArray());
        // Generate new fake data for update
        $payload = [
            'user_id' => $vendor->id,
            'phone' => $this->faker->numerify('##########'),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'cnic' => $this->faker->numerify('#############'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'bank_account_number' => $this->faker->numerify('###############'),
            'bank_name' => $this->faker->company,
        ];

        // Perform PUT request to update the vendor
        dump(Vendor::all()->toArray());
        $response = $this->actingAs($user)->post('/vendor/on-boarding/update/'.$vendor->id, $payload);
        dump($response);
        // Verify the database has the fake data
        $this->assertDatabaseHas('vendors', [
            'user_id' => $vendor->id,
            'phone' => $payload['phone'],
            'bank_name' => $payload['bank_name'],
        ]);
    }
}
