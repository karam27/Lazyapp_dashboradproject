<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => "admin@213",
        ])->assignRole('admin');

        User::create([
            'name' => 'doctor',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => 'doctor@213',
        ])->assignRole('doctor');
    }
}
