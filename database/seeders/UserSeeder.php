<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'ahmed.emam.dev@gmail.com'],
            [
                'first_name' => 'Ahmed',
                'last_name' => 'TechLead',
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
                'password' => Hash::make('password'),
            ]
        );
    }
}
