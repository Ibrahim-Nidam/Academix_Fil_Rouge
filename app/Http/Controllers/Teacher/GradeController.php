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
    
    public function getClassroomStudents($classroomId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        $students = User::whereHas('student', function($query) use ($classroomId) {
            $query->where('classroom_id', $classroomId);
        })->get();
        
        return response()->json([
            'classroom' => $classroom,
            'students' => $students
        ]);
    }
    
    public function getExamAssignments($classroomId)
    {
        $exams = ExamAssignment::where('classroom_id', $classroomId)
            ->where('teacher_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
            
        return response()->json($exams);
    }

}