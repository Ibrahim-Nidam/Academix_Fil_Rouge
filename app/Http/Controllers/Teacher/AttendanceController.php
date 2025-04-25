<?php
namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getStudents($classroom_id)
    {
        $students = Student::with('user')
                    ->where('classroom_id', $classroom_id)
                    ->get();
                    
        foreach ($students as $student) {
            $student->attendance = Attendance::where('student_id', $student->user_id)
                                    ->where('classroom_id', $classroom_id)
                                    ->orderBy('date', 'desc')
                                    ->get();
        }
        return response()->json($students);
    }

    public function submitAttendance(Request $request)
    {
        $data = $request->validate([
            'records' => 'required|array',
            'records.*.classroom_id' => 'required|integer',
            'records.*.student_id' => 'required|uuid',
            'records.*.status' => 'required|in:present,absent',
            'records.*.date' => 'required|date',
            'records.*.schedule_id' => 'required|integer',
        ]);

        foreach ($data['records'] as $record) {
            Attendance::updateOrCreate(
                [
                    'classroom_id' => $record['classroom_id'],
                    'student_id' => $record['student_id'],
                    'date' => $record['date'],
                    'schedule_id' => $record['schedule_id']
                ],
                [
                    'status' => $record['status']
                ]
            );
        }

        return response()->json(['message' => 'Attendance submitted successfully']);
    }
}