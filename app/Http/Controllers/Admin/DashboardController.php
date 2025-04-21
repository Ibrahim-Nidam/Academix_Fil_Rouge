<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $maleStudents = User::where('role', 'Student')->where('gender', 'Male')->count();
        $femaleStudents = User::where('role', 'Student')->where('gender', 'Female')->count();
        $totalStudents = $maleStudents + $femaleStudents;

        $maleStaff = User::where('role', 'Teacher')->where('gender', 'Male')->count();
        $femaleStaff = User::where('role', 'Teacher')->where('gender', 'Female')->count();
        $totalStaff = $maleStaff + $femaleStaff;

        // Merge classrooms by grade
        $classrooms = Classroom::all()->groupBy(function($classroom) {
            preg_match('/Class (\d+)[A-Z]/', $classroom->name, $matches);
            return isset($matches[1]) ? $matches[1] : null;
        })->sortKeys();

        $attendanceData = [
            'present' => [],
            'absent' => []
        ];
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        
        $week = request()->get('week', 'current');

        $startOfWeek = now()->startOfWeek();
        if ($week === 'previous') {
            $startOfWeek->subWeek();
        }
        $today = now();
        
        $totalStudents = User::where('role', 'Student')->count();
        
        foreach ($days as $index => $day) {
            $date = $startOfWeek->copy()->addDays($index);
        
            if ($date->lte($today)) {
                $presentStudents = Attendance::whereDate('date', $date)
                    ->where('status', 'present')
                    ->count();
        
                $presentPercentage = $totalStudents > 0 ? round(($presentStudents / $totalStudents) * 100) : 0;
                $absentPercentage = 100 - $presentPercentage;
            } else {
                $presentPercentage = null;
                $absentPercentage = null;
            }
        
            $attendanceData['present'][] = $presentPercentage;
            $attendanceData['absent'][] = $absentPercentage;
        }

        $subjects = Subject::all();

        $performanceData = [];
        foreach ($subjects as $subject) {
            $subjectData = ['name' => $subject->name, 'grades' => []];
            
            foreach ($classrooms as $grade => $classroomGroup) {
                $subjectData['grades'][$grade] = [];
                
                foreach ($classroomGroup->sortBy('name') as $classroom) {
                    $avgScore = Grade::join('exam_assignments', 'grades.exam_assignment_id', '=', 'exam_assignments.id')
                        ->where('exam_assignments.classroom_id', $classroom->id)
                        ->join('subject_teacher', 'exam_assignments.teacher_id', '=', 'subject_teacher.teacher_id')
                        ->where('subject_teacher.subject_id', $subject->id)
                        ->avg('grades.score');

                    $subjectData['grades'][$grade][$classroom->name] = round($avgScore ?: rand(70, 90));
                }
            }

            $performanceData[] = $subjectData;
        }

        return view('admin.dashboard', compact(
            'maleStudents', 'femaleStudents', 'totalStudents',
            'maleStaff', 'femaleStaff', 'totalStaff',
            'attendanceData', 'performanceData'
        ));
    }
}
