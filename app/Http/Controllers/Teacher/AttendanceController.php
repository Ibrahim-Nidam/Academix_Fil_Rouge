<?php

namespace App\Http\Controllers\Teacher;



class AttendanceController extends Controller
{
    public function getClassesForDay($day)
    {
        $teacherId = Auth::user()->id;

        $classes = Schedule::with('classroom')
                    ->where('teacher_id', $teacherId)
                    ->where('day_of_week', $day)
                    ->get();

        return response()->json($classes);
    }

}