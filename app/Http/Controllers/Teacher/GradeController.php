<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $classrooms = $teacher->classrooms;
        
        foreach ($classrooms as $classroom) {
            $classroom->subjects = $teacher->subjects;
        }
        
        return view('teacher.grades', [
            'classrooms' => $classrooms
        ]);
    }

}