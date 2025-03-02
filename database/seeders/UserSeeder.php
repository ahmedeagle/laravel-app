<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'TechLead',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(10)->create(); // Generate 10 random users
    }
}
