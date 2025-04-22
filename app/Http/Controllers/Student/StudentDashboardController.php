<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamAssignment;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->with('classroom')->first();
        
        $today = Carbon::now();
        $currentDayOfWeek = $today->format('l');
        
        // Get today's schedule
        $todaySchedules = Schedule::where('classroom_id', $student->classroom_id)
            ->where('day_of_week', $currentDayOfWeek)
            ->orderBy('start_time')
            ->get();
        
        // Format schedule data for view
        $formattedTodaySchedules = [];
        $currentTime = Carbon::now()->format('H:i:s');
        
        foreach ($todaySchedules as $schedule) {
            $isCurrent = $currentTime >= $schedule->start_time && $currentTime <= $schedule->end_time;
            
            $formattedTodaySchedules[] = [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'start_time' => Carbon::parse($schedule->start_time)->format('g:i A'),
                'end_time' => Carbon::parse($schedule->end_time)->format('g:i A'),
                'room' => $schedule->room,
                'is_current' => $isCurrent
            ];
        }
        
        // Get weekly timetable
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $weeklySchedule = [];
        $timeSlots = [];
        
        $allSchedules = Schedule::where('classroom_id', $student->classroom_id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        
        foreach ($allSchedules as $schedule) {
            $startTime = Carbon::parse($schedule->start_time)->format('H:i');
            $endTime = Carbon::parse($schedule->end_time)->format('H:i');
            $timeSlot = $startTime . ' - ' . $endTime;
            
            if (!in_array($timeSlot, $timeSlots)) {
                $timeSlots[] = $timeSlot;
            }
            
            if (!isset($weeklySchedule[$schedule->day_of_week])) {
                $weeklySchedule[$schedule->day_of_week] = [];
            }
            
            $weeklySchedule[$schedule->day_of_week][] = [
                'title' => $schedule->title,
                'room' => $schedule->room,
                'time_slot' => $timeSlot
            ];
        }
        
        sort($timeSlots);
        
        // timetable grid
        $timetable = [];
        foreach ($timeSlots as $timeSlot) {
            $row = ['time' => $timeSlot];
            foreach ($days as $day) {
                $class = null;
                if (isset($weeklySchedule[$day])) {
                    foreach ($weeklySchedule[$day] as $schedule) {
                        if ($schedule['time_slot'] == $timeSlot) {
                            $class = [
                                'title' => $schedule['title'],
                                'room' => $schedule['room']
                            ];
                            break;
                        }
                    }
                }
                $row[$day] = $class;
            }
            $timetable[] = $row;
        }
        
        // student grades
        $examAssignments = ExamAssignment::where('classroom_id', $student->classroom_id)->pluck('id');
        $grades = Grade::whereIn('exam_assignment_id', $examAssignments)
            ->where('student_id', $user->id)
            ->with('examAssignment')
            ->get();
        
        // average grade
        $overallGrade = $grades->count() > 0 ? round($grades->avg('score'), 2) : 0;
        
        // grade message
        $gradeMessage = '';
        if ($overallGrade >= 16) {
            $gradeMessage = 'You\'re performing exceptionally well!';
        } elseif ($overallGrade >= 14) {
            $gradeMessage = 'You\'re performing well above average!';
        } elseif ($overallGrade >= 10) {
            $gradeMessage = 'You\'re performing at an average level.';
        } else {
            $gradeMessage = 'You should focus on improving your grades.';
        }
        
        // average for each subject
        $subjectGrades = [];
        foreach ($grades as $grade) {
            $subject = $grade->examAssignment->title;
            if (!isset($subjectGrades[$subject])) {
                $subjectGrades[$subject] = ['total' => 0, 'count' => 0];
            }
            $subjectGrades[$subject]['total'] += $grade->score;
            $subjectGrades[$subject]['count']++;
        }
        
        $subjectAverages = [];
        foreach ($subjectGrades as $subject => $data) {
            $average = round($data['total'] / $data['count'], 2);
            $subjectAverages[$subject] = [
                'score' => $average,
                'percentage' => $average * 5,
                'class' => $average >= 16 ? 'progress-fill-high' : ($average >= 10 ? 'progress-fill-medium' : 'progress-fill-low'),
                'badge' => $average >= 16 ? 'badge-success' : ($average >= 10 ? 'badge-warning' : 'badge-danger')
            ];
        }
        
        // subjects top 3
        $bestSubjects = [];
        $bestSubjectsList = collect($subjectAverages)->sortByDesc('score')->take(3);
        foreach ($bestSubjectsList as $subject => $data) {
            $bestSubjects[] = [
                'name' => $subject,
                'score' => $data['score'],
                'percentage' => $data['percentage'],
                'class' => $data['class'],
                'badge' => $data['badge']
            ];
        }
        
        // subjects bottom 3
        $improvementSubjects = [];
        $improvementSubjectsList = collect($subjectAverages)->sortBy('score')->take(3);
        foreach ($improvementSubjectsList as $subject => $data) {
            $improvementSubjects[] = [
                'name' => $subject,
                'score' => $data['score'],
                'percentage' => $data['percentage'],
                'class' => $data['class'],
                'badge' => $data['badge']
            ];
        }
        
        return view('student.dashboard', compact(
            'formattedTodaySchedules',
            'timetable',
            'overallGrade',
            'gradeMessage',
            'bestSubjects',
            'improvementSubjects'
        ));
    }
}