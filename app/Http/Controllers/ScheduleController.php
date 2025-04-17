<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Classroom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('admin.planningPage', [
            'teachers' => User::where('role', 'Teacher')->get(),
            'classes'  => Classroom::all(),
            'schedules'=> Schedule::with(['teacher', 'classroom'])->get()
        ]);
    }


    public function store(Request $request)
    {
        $validated = $this->validateSchedule($request);

        if ($conflict = $this->checkConflicts($validated)) {
            return response()->json(['success' => false, 'message' => $conflict], 422);
        }

        $schedule = Schedule::create($validated);

        return response()->json(['success' => true, 'id' => $schedule->id]);
    }



    private function validateSchedule(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'room' => 'required|string|max:255',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
    }

    private function checkConflicts(array $data)
    {
        $conditions = [
            'room' => ['room' => $data['room']],
            'teacher' => ['teacher_id' => $data['teacher_id']],
            'classroom' => ['classroom_id' => $data['classroom_id']]
        ];

        foreach ($conditions as $type => $where) {
            $conflict = Schedule::where($where)
                ->where('day_of_week', $data['day_of_week'])
                ->where(function ($query) use ($data) {
                    $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                            ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                            ->orWhere(function ($q) use ($data) {
                            $q->where('start_time', '<=', $data['start_time'])
                            ->where('end_time', '>=', $data['end_time']);
                        });
                })->first();

            if ($conflict) {
                switch ($type) {
                    case 'room':
                        return 'This room is already booked during this time period.';
                    case 'teacher':
                        return 'This teacher already has a class scheduled during this time period.';
                    case 'classroom':
                        return 'This class already has a session scheduled during this time period.';
                }
            }
        }

        return null;
    }
}
