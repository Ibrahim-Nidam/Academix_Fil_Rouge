<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'id' => '9e850d83-8a09-4da1-bfe6-d25eb82971a8',
            'first_name' => 'ibrahim',
            'last_name' => 'nidam',
            'username' => 'IN',
            'email' => 'i@n.c',
            'password' => Hash::make('a'),
            'gender' => 'Male',
            'role' => 'Admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => '9e850d83-8a09-4da1-bfe6-d25eb82971a6',
            'first_name' => 'ibrahim',
            'last_name' => 'nidam',
            'username' => 'TN',
            'email' => 't@n.c',
            'password' => Hash::make('a'),
            'gender' => 'Male',
            'role' => 'Teacher',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => '9e850d83-8a09-4da1-bfe6-d25eb82971b8',
            'first_name' => 'ibrahim',
            'last_name' => 'nidam',
            'username' => 'SN',
            'email' => 's@n.c',
            'password' => Hash::make('a'),
            'gender' => 'Male',
            'role' => 'Student',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([
            ClassesSeeder::class,
            SubjectsSeeder::class,
            StudentsSeeder::class,
            // AttendanceSeeder::class,
        ]);
        
        // // Get teacher id
        // $teacherId = '9e850d83-8a09-4da1-bfe6-d25eb82971a6';

        // // Get all subjects
        // $subjectIds = DB::table('subjects')->pluck('id');

        // // Link teacher to all subjects (or specific ones if you prefer)
        // foreach ($subjectIds as $subjectId) {
        //     DB::table('subject_teacher')->insert([
        //         'subject_id' => $subjectId,
        //         'teacher_id' => $teacherId,
        //     ]);
        // }
        // $this->call(ScheduleSeeder::class);
    }
}
