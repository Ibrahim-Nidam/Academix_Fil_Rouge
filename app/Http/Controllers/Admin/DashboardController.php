<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

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

        $grades = Grade::join('exam_assignments', 'grades.exam_assignment_id', '=', 'exam_assignments.id')
            ->join('subject_teacher', 'exam_assignments.teacher_id', '=', 'subject_teacher.teacher_id')
            ->selectRaw('exam_assignments.classroom_id, subject_teacher.subject_id, AVG(grades.score) as avg_score')
            ->groupBy('exam_assignments.classroom_id', 'subject_teacher.subject_id')
            ->get();

        $gradeMap = [];
        foreach ($grades as $grade) {
            $gradeMap[$grade->subject_id][$grade->classroom_id] = round(($grade->avg_score / 20) * 100);
        }

        $performanceData = [];
        foreach ($subjects as $subject) {
            $subjectData = ['name' => $subject->name, 'grades' => []];
            
            foreach ($classrooms as $grade => $classroomGroup) {
                $subjectData['grades'][$grade] = [];
                
                foreach ($classroomGroup->sortBy('name') as $classroom) {
                    $score = $gradeMap[$subject->id][$classroom->id] ?? rand(70, 90);
                    $subjectData['grades'][$grade][$classroom->name] = $score;
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
