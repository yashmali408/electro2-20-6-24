<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\System;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Delete the user if it exists
        User::where('email', 'admin1@gmail.com')->delete();

        User::factory()->create([
            'name' => 'yash',
            'surname' => 'mali',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin1@gmail.com'), // Use Hash::make to hash the password
            'role' => 'admin',
        ]);

        // Update or create system settings
        $settings = [
            ['meta_name' => 'app_name', 'meta_value' => 'Flipkart'],
            ['meta_name' => 'app_version', 'meta_value' => '1.0.0'],
            ['meta_name' => 'app_logo', 'meta_value' => 'https://findvectorlogo.com/wp-content/uploads/2019/03/flipkart-vector-logo.png'],
        ];

        foreach ($settings as $setting) {
            System::updateOrCreate(
                ['meta_name' => $setting['meta_name']],
                ['meta_value' => $setting['meta_value']]
            );
        }
    }
}
