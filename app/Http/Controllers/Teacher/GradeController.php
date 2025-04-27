<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ExamAssignment;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    
    public function getGrades($examId)
    {
        $exam = ExamAssignment::with('classroom')->findOrFail($examId);
        
        if ($exam->teacher_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $students = User::whereHas('student', function($query) use ($exam) {
            $query->where('classroom_id', $exam->classroom_id);
        })->get();
        
        $grades = Grade::where('exam_assignment_id', $examId)->get()->keyBy('student_id');
        
        $studentsWithGrades = $students->map(function($student) use ($grades) {
            $grade = $grades->get($student->id);
            return [
                'id' => $student->id,
                'name' => $student->first_name . ' ' . $student->last_name,
                'grade' => $grade ? $grade->score : null,
                'comment' => $grade ? $grade->comment : '',
            ];
        });
        
        return response()->json([
            'exam' => $exam,
            'students' => $studentsWithGrades
        ]);
    }
    
    public function submitGrades(Request $request, $examId)
    {
        $exam = ExamAssignment::findOrFail($examId);
        
        if ($exam->teacher_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $grades = $request->input('grades');
        
        foreach ($grades as $studentId => $gradeData) {
            Grade::updateOrCreate(
                [
                    'exam_assignment_id' => $examId,
                    'student_id' => $studentId
                ],
                [
                    'score' => $gradeData['score'],
                    'comment' => $gradeData['comment'] ?? null
                ]
            );
        }
        
        return response()->json(['message' => 'Grades submitted successfully']);
    }
}