<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ExamAssignment;
use App\Models\Grade;
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
        $classAverages = [];
        $classPerformanceData = [];

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

            $examAssignments = ExamAssignment::where('classroom_id', $classroom->id)
                ->where('teacher_id', $teacher->id)
                ->pluck('id');

            if ($examAssignments->count() > 0) {
                $grades = Grade::whereIn('exam_assignment_id', $examAssignments)->get();

                if ($grades->count() > 0) {
                    $averageScore = $grades->avg('score');
                    $classAverages[$classroom->id] = round($averageScore, 1);
                } else {
                    $classAverages[$classroom->id] = 0;
                }
            } else {
                $classAverages[$classroom->id] = 0;
            }
        }

        foreach ($classrooms as $classroom) {
            $examAssignments = ExamAssignment::where('classroom_id', $classroom->id)
                ->where('teacher_id', $teacher->id)
                ->get();

            if ($examAssignments->count() > 0) {
                $studentPerformance = [];
                $students = $classroom->students()->with('user')->get();

                foreach ($students as $student) {
                    $totalScore = 0;
                    $totalPossibleScore = 0;
                
                    foreach ($examAssignments as $assignment) {
                        $grade = Grade::where('exam_assignment_id', $assignment->id)
                            ->where('student_id', $student->user_id)
                            ->first();
                
                        $maxScorePerAssignment = 20;
                        $totalPossibleScore += $maxScorePerAssignment;
                
                        if ($grade) {
                            $totalScore += $grade->score;
                        }
                    }
                
                    if ($totalPossibleScore > 0) {
                        $percentage = ($totalScore / $totalPossibleScore) * 100;
                
                        $studentPerformance[] = [
                            'id' => $student->user_id,
                            'name' => ucfirst($student->user->first_name) . ' ' . ucfirst($student->user->last_name),
                            'score' => round($percentage, 1),
                            'classroom_name' => $classroom->name,
                            'assignments_count' => $examAssignments->count()
                        ];
                    }
                }                

                usort($studentPerformance, function ($a, $b) {
                    return $b['score'] <=> $a['score'];
                });

                $topPerformers = array_slice($studentPerformance, 0, 3);
                $lowestPerformers = array_slice(array_reverse($studentPerformance), 0, 3);

                $classPerformanceData[$classroom->id] = [
                    'top' => $topPerformers,
                    'lowest' => $lowestPerformers
                ];
            } else {
                $classPerformanceData[$classroom->id] = [
                    'top' => [],
                    'lowest' => []
                ];
            }
        }

        return view('teacher.dashboard', [
            'classrooms' => $classrooms,
            'totalStudents' => $totalStudents,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
            'todaySchedules' => $todaySchedules,
            'classGenderDistribution' => $classGenderDistribution,
            'classAverages' => $classAverages,
            'classPerformanceData' => $classPerformanceData
        ]);
    }
}