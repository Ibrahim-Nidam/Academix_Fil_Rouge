<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ExamAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamAssignmentController extends Controller
{
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

        
    public function getExamAssignments($classroomId)
    {
        $exams = ExamAssignment::where('classroom_id', $classroomId)
            ->where('teacher_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
            
        return response()->json($exams);
    }
}
