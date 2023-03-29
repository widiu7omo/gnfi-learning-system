<?php

namespace Database\Seeders;

use App\Models\StudyClass;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::create(['name' => 'staff', 'guard_name' => 'web']);
        Role::create(['name' => 'student', 'guard_name' => 'web']);

        $superAdmin = User::create([
            'name' => "Super Admin",
            "email" => "super@adm.com",
            'password' => bcrypt('super'),
            'email_verified_at' => now(),
        ]);
        $staff = User::create([
            'name' => "Staff",
            "email" => "staff@adm.com",
            'password' => bcrypt('staff'),
            'email_verified_at' => now(),
        ]);
        $student = User::create([
            'name' => "Student",
            "email" => "student@adm.com",
            'password' => bcrypt('student'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole(['super_admin']);
        $staff->assignRole(['staff']);
        $student->assignRole(['student']);
        User::factory()->count(20)->create();
        User::doesntHave('roles')->each(fn($user) => $user->assignRole(['student']));
        StudyClass::factory()->count(20)->create();
    }
}
