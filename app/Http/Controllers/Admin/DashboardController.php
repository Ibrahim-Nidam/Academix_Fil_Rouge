<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('admin.dashboard', compact(
            'maleStudents', 'femaleStudents', 'totalStudents',
            'maleStaff', 'femaleStaff', 'totalStaff'
        ));
    }
}
