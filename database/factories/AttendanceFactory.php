<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'classroom_id' => Classroom::factory(),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['present', 'absent']),
        ];
    }
}
