<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'phone_number' => '0123456789',
            'identification_type' => 'Ghana Card',
            'identification_number' => 'GHA123456789',
            //'is_admin' => true,
        ]);

        // Create regular users
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'olives@example.com',
            'password' => Hash::make('password123'),
            'phone_number' => '0553306360',
            'identification_type' => 'Ghana Card',
            'identification_number' => 'GHA987654321',
            //'is_admin' => false,
        ]);

        // Create more test users if needed
        User::factory(8)->create();
    }
}
