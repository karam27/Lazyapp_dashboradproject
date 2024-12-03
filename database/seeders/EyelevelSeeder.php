<?php

namespace Database\Seeders;

use App\Models\EyeLevel;
use App\Models\User;
use Illuminate\Database\Seeder;

class EyelevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $child = User::whereHas('roles', function ($query) {
            $query->where('name', 'child');
        })->get();

        foreach ($child as $child) {
            EyeLevel::create([
                'user_id' => $child->id,
                'level' => 'مستوى ' . rand(1, 5),
                'exam_date' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
