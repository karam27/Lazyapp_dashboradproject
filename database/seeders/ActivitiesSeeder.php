<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $children = User::where('role', 'child')->get();
        foreach ($children as $child) {
            Activity::create([
                'user_id' => $child->id,
                'activity_name' =>  'نشاط  العين' . rand(1, 5),
                'duration' => rand(15, 60),
                'date' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
