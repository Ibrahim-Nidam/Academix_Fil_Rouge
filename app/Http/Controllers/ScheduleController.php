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

    public function events(Request $request)
    {
        $schedules = Schedule::with(['teacher', 'classroom'])->get();
        $startDate = $request->filled('start') ? Carbon::parse($request->start) : Carbon::now()->startOfMonth();
        $endDate = $request->filled('end') ? Carbon::parse($request->end) : Carbon::now()->endOfMonth();

        $events = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dayOfWeek = $date->format('l');
            if (!in_array($dayOfWeek, ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])) {
                continue;
            }

            $daySchedules = $schedules->where('day_of_week', $dayOfWeek);

            foreach ($daySchedules as $schedule) {
                $events[] = [
                    'id' => $schedule->id,
                    'title' => $schedule->title,
                    'start' => $date->copy()->setTimeFromTimeString($schedule->start_time)->toIso8601String(),
                    'end' => $date->copy()->setTimeFromTimeString($schedule->end_time)->toIso8601String(),
                    'extendedProps' => [
                        'teacher' => $schedule->teacher_id,
                        'classroom' => $schedule->classroom_id,
                        'room' => $schedule->room,
                        'recurring' => true,
                        'day_of_week' => $schedule->day_of_week
                    ],
                ];
            }
        }

        return response()->json($events);
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

    public function update(Request $request, $id)
    {
        $validated = $this->validateSchedule($request);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($validated);

        return response()->json(['success' => true, 'message' => 'Schedule updated successfully.']);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(['success' => true]);
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
