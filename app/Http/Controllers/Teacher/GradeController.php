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
    
    public function createExamAssignment(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'type' => 'required|in:exam,assignment,quiz,project',
            'date' => 'required|date'
        ]);
        
        $validated['teacher_id'] = Auth::id();
        
        $exam = ExamAssignment::create($validated);
        
        return response()->json($exam);
    }

}