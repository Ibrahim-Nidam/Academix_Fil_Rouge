<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Classroom;

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

}
