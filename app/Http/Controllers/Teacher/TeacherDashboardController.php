<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use Carbon\Carbon;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        $classrooms = $teacher->classrooms;

        $maleCount = 0;
        $femaleCount = 0;

        foreach ($classrooms as $classroom) {
            $students = $classroom->students()->with('user')->get();

            foreach ($students as $student) {
                if ($student->user->gender === 'Male') {
                    $maleCount++;
                } else {
                    $femaleCount++;
                }
            }
        }

        $totalStudents = $maleCount + $femaleCount;

        $today = Carbon::now()->format('l');
        $todaySchedulesRaw = Schedule::where('teacher_id', $teacher->id)
            ->where('day_of_week', $today)
            ->orderBy('start_time', 'asc')
            ->with('classroom')
            ->get();

        $todaySchedules = [];
        $classGenderDistribution = [];

        foreach ($todaySchedulesRaw as $schedule) {
            $schedule->start_time_formatted = Carbon::parse($schedule->start_time)->format('h:i A');
            $schedule->end_time_formatted = Carbon::parse($schedule->end_time)->format('h:i A');
            $todaySchedules[] = $schedule;

            $classroom = $schedule->classroom;
            $students = $classroom->students()->with('user')->get();

            $classMaleCount = $students->where('user.gender', 'Male')->count();
            $classFemaleCount = $students->where('user.gender', 'Female')->count();

            $classGenderDistribution[$classroom->id] = [
                'male' => $classMaleCount,
                'female' => $classFemaleCount,
                'total' => $classMaleCount + $classFemaleCount
            ];
        }

        return view('teacher.dashboard', [
            'classrooms' => $classrooms,
            'totalStudents' => $totalStudents,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
            'todaySchedules' => $todaySchedules,
            'classGenderDistribution' => $classGenderDistribution
        ]);
    }
}