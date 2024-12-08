<?php

namespace Database\Seeders;

use App\Models\Caregiver;
use App\Models\Child;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaregiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Ali Ahmed',
            'email' => 'ali@example.com',
            'password' => bcrypt('password123'),
            'role' => 'caregiver',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Caregiver::create([
            'user_id' => $user->id,
            'name' => $user->name,
        ]);
    }
}
