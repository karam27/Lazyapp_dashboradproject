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
            [
                'name' => 'child 2',
                'email' => 'child2@example.com',
                'password' => bcrypt('child@32142'),
                'role' => 'child',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'child 3',
                'email' => 'child3@example.com',
                'password' => bcrypt('child@413435'),
                'role' => 'child',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'child 4',
                'email' => 'child4@example.com',
                'password' => bcrypt('child@21345'),
                'role' => 'child',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'child 5',
                'email' => 'child5@example.com',
                'password' => bcrypt('child@98765'),
                'role' => 'child',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        $children = User::where('role', 'child')->get();
        foreach ($children as $child) {
            // إنشاء السجل في جدول `children` باستخدام `user_id`
            Child::create([
                'user_id' => $child->id,  // ربط الطفل بالمستخدم
                'name' => $child->name,
                'last_exam_date' => Carbon::now()->subDays(rand(1, 30)),  // استخدام اسم المستخدم كاسم الطفل     // تعيين عمر عشوائي بين 5 و 15 سنة
            ]);

            // ربط الأطفال مع سجلات EyeLevel
            EyeLevel::create([
                'user_id' => $child->id,
                'level' => 'مستوى ' . rand(1, 5),  // تعيين مستوى عشوائي من 1 إلى 5
                'exam_date' => Carbon::now()->subDays(rand(1, 30)),  // تعيين تاريخ عشوائي للفحص
            ]);
        }
    }
}
