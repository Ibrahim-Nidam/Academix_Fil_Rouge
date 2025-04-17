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

    
}
