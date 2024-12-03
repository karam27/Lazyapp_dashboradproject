<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'child 1',
            'email' => 'child1@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('child@123'), // تشفير كلمة المرور
        ])->assignRole('child');
        User::create([
            'name' => 'child 2',
            'email' => 'child2example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('child@32142'), // تشفير كلمة المرور
        ])->assignRole('child');
        User::create([
            'name' => 'child 3',
            'email' => 'child3example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('child@413435'), // تشفير كلمة المرور
        ])->assignRole('child');
    }
}
