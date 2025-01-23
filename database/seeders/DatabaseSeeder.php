<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
<<<<<<< HEAD
            'name' => 'Athar',
            'email' => 'admin@athnim.com',
=======
            'name' => 'Test User',
            'email' => 'usama.asghar7868@gmail.com',
>>>>>>> 4b700c24fef8d3699b16dfd5da6432a611bdd029
        ]);
    }
}
