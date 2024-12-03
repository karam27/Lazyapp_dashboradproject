<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $children = User::whereHas('roles', function ($query) {
            $query->where('name', 'child');
        })->pluck('name');
        foreach ($children as $child) {
            Activity::create([
                'child_name' => $child,
                'activity_name' => 'تمرين العين',
                'duration' => rand(10, 30),
                'date' => now()->subDays(rand(1, 7)),
            ]);
        }
    }
}
