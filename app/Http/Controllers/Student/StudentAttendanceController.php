<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentAttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;
        
        $schedules = Schedule::where('classroom_id', $student->classroom_id)
            ->where('day_of_week', '!=', 'Sunday')
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
            
        $attendances = Attendance::where('student_id', $user->id)
            ->whereExists(function($query) use ($student) {
                $query->select(DB::raw(1))
                    ->from('schedules')
                    ->where('classroom_id', $student->classroom_id)
                    ->where('day_of_week', '!=', 'Sunday')
                    ->whereRaw("TRIM(TO_CHAR(attendances.date, 'Day')) = schedules.day_of_week");
            })
            ->orderBy('date', 'desc')
            ->get();

            
        $totalAttendances = $attendances->count();
        $presentCount = $attendances->where('status', 'present')->count();
        $absentCount = $attendances->where('status', 'absent')->count();
        
        $presentPercentage = $totalAttendances > 0 ? round(($presentCount / $totalAttendances) * 100, 1) : 0;
        $absentPercentage = $totalAttendances > 0 ? round(($absentCount / $totalAttendances) * 100, 1) : 0;
        
        // group attendances by month and day for display
        $groupedAttendances = [];

        foreach ($attendances as $attendance) {
            $date = Carbon::parse($attendance->date);
            $month = $date->format('F Y');
            $day = $date->format('d');
            $dayOfWeek = $date->format('l');

            // Skip Sundays
            if ($dayOfWeek === 'Sunday') {
                continue;
            }

            // find schedules for this day of week
            $daySchedules = $schedules->filter(function($schedule) use ($dayOfWeek) {
                return $schedule->day_of_week === $dayOfWeek;
            });

            // skip if no schedules for this day
            if ($daySchedules->isEmpty()) {
                continue;
            }

            if (!isset($groupedAttendances[$month])) {
                $groupedAttendances[$month] = [];
            }

            if (!isset($groupedAttendances[$month][$day])) {
                $groupedAttendances[$month][$day] = [
                    'date' => $date->format('Y-m-d'),
                    'is_today' => $date->isToday(),
                    'entries' => []
                ];
            }

            foreach ($daySchedules as $schedule) {
                $teacher = $schedule->teacher ? $schedule->teacher->first_name . ' ' . $schedule->teacher->last_name : 'N/A';

                $groupedAttendances[$month][$day]['entries'][] = [
                    'attendance_status' => ucfirst($attendance->status),
                    'subject' => $schedule->title,
                    'time' => Carbon::parse($schedule->start_time)->format('g:i A') . ' - ' . Carbon::parse($schedule->end_time)->format('g:i A'),
                    'room' => $schedule->room ? 'Room ' . $schedule->room : 'N/A',
                    'teacher' => $teacher
                ];
            }
        }

        $startDate = Carbon::now()->subMonths(1)->startOfMonth();
        $endDate = Carbon::now()->addMonths(1)->endOfMonth();
        
        $totalScheduledClasses = $this->calculateTotalScheduledClasses($schedules, $startDate, $endDate);
            
        return view('student.attendance', compact(
            'attendances', 
            'totalAttendances', 
            'presentCount', 
            'absentCount', 
            'presentPercentage', 
            'absentPercentage', 
            'groupedAttendances',
            'schedules',
            'totalScheduledClasses'
        ));
    }

    private function calculateTotalScheduledClasses($schedules, $startDate, $endDate)
    {
        $totalClasses = 0;
        $currentDate = $startDate->copy();
        
        while ($currentDate->lte($endDate)) {
            $dayOfWeek = $currentDate->format('l');
            
            if ($dayOfWeek !== 'Sunday') {
                $daySchedules = $schedules->where('day_of_week', $dayOfWeek);
                $totalClasses += $daySchedules->count();
            }
            
            $currentDate->addDay();
        }
        
        return $totalClasses;
    }
}
