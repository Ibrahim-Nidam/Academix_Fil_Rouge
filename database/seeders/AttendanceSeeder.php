<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $now = Carbon::now();

        $studentIds = DB::table('students')->pluck('user_id');  // we store user_id in student_id

        $attendanceRecords = [];

        foreach ($studentIds as $studentId) {
            $classroomId = DB::table('students')->where('user_id', $studentId)->value('classroom_id');

            for ($i = 0; $i < 6; $i++) {
                $attendanceRecords[] = [
                    'student_id' => $studentId,
                    'classroom_id' => $classroomId,
                    'date' => $now->copy()->subDays($i),
                    'status' => $faker->randomElement(['present', 'absent']),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('attendances')->insert($attendanceRecords);
    }
}