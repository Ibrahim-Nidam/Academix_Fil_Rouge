<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StudentsSeeder extends Seeder
{
    public function run()
    {
        $passwordHash = '$2a$12$7NjKYlcb43SYjwaItTuNS.AMTMlqbU4HpcNoo4OUBd7glm3Y77Dt6';
        $classroomIds = range(1, 10); // classrooms 1 to 10
        $students = [];
        $users = [];
        $faker = \Faker\Factory::create();
        $now = Carbon::now();

        for ($i = 0; $i < 200; $i++) {
            $userId = Str::uuid()->toString();
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $username = strtolower($firstName) . ucfirst($lastName);
            $email = strtolower($firstName) . '.' . strtolower($lastName) . '@student.com';
            $gender = $faker->randomElement(['Male', 'Female']);

            $users[] = [
                'id' => $userId,
                'profile_image' => null,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => $email,
                'password' => $passwordHash,
                'gender' => $gender,
                'role' => 'Student',
                'status' => 'Active',
                'date_of_birth' => null,
                'additional_email' => null,
                'email_verified_at' => null,
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $classroomId = $classroomIds[intdiv($i, 20)]; // 20 students per class

            $students[] = [
                'user_id' => $userId,
                'classroom_id' => $classroomId,
                'grade' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Bulk insert into users table
        DB::table('users')->insert($users);

        // Bulk insert into students table
        DB::table('students')->insert($students);
    }
}
