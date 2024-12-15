<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\EyeLevel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EyelevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'child 1',
                'email' => 'child1@example.com',
                'password' => bcrypt('child@123'),
                'role' => 'child',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $caregiver = User::where('role', 'caregiver')->first();
        $child = User::where('role', 'child')->first();
        if ($child && $caregiver) { // تأكد من وجود الـ child و الـ caregiver
            Child::create([
                'user_id' => $child->id,
                'caregivers_id' => $caregiver->id, // ربط الطفل بالـ caregiver
                'name' => $child->name,
                'last_exam_date' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            EyeLevel::create([
                'user_id' => $child->id,
                'level' => 'مستوى ' . rand(1, 5),
                'exam_date' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
