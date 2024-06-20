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
            'name' => 'Anil',
            'surname' => 'Dollor',
            'email' => 'admin1@gmail.com',
            'password' => 'admin1@gmail.com',
            'role' => 'admin',

        ]);
    }
}
