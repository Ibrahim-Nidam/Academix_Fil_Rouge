<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamAssignment;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentGradeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        
        // get all grades
        $grades = Grade::join('exam_assignments', 'grades.exam_assignment_id', '=', 'exam_assignments.id')
            ->where('grades.student_id', $user->id)
            ->select(
                'grades.*', 
                'exam_assignments.title', 
                'exam_assignments.type', 
                'exam_assignments.date',
                'exam_assignments.classroom_id',
                'exam_assignments.teacher_id'
            )
            ->get();
            
        // Get subject
        $subjectsData = ExamAssignment::join('classroom_teacher', function($join) use ($grades) {
                $join->on('exam_assignments.classroom_id', '=', 'classroom_teacher.classroom_id')
                    ->on('exam_assignments.teacher_id', '=', 'classroom_teacher.teacher_id');
            })
            ->join('subject_teacher', 'exam_assignments.teacher_id', '=', 'subject_teacher.teacher_id')
            ->join('subjects', 'subject_teacher.subject_id', '=', 'subjects.id')
            ->whereIn('exam_assignments.id', $grades->pluck('exam_assignment_id'))
            ->select('exam_assignments.id as exam_id', 'subjects.name as subject_name', 'subjects.id as subject_id')
            ->distinct()
            ->get();
            
        $examSubjectMap = [];
        foreach ($subjectsData as $data) {
            $examSubjectMap[$data->exam_id] = [
                'name' => $data->subject_name,
                'id' => $data->subject_id
            ];
        }
        
        // group grades by subject
        $subjectGrades = [];
        foreach ($grades as $grade) {
            if (isset($examSubjectMap[$grade->exam_assignment_id])) {
                $subjectName = $examSubjectMap[$grade->exam_assignment_id]['name'];
                $subjectId = $examSubjectMap[$grade->exam_assignment_id]['id'];
                
                if (!isset($subjectGrades[$subjectName])) {
                    $subjectGrades[$subjectName] = [
                        'id' => $subjectId,
                        'grades' => [],
                        'total' => 0,
                        'count' => 0
                    ];
                }
                
                $subjectGrades[$subjectName]['grades'][] = $grade;
                $subjectGrades[$subjectName]['total'] += $grade->score;
                $subjectGrades[$subjectName]['count']++;
            }
        }
        
        // averages for each subject
        foreach ($subjectGrades as $subject => $data) {
            $subjectGrades[$subject]['average'] = $data['count'] > 0 ? round($data['total'] / $data['count'], 1) : 0;
        }
        
        // total average
        $totalScore = 0;
        $totalCount = 0;
        foreach ($subjectGrades as $subject => $data) {
            $totalScore += $data['total'];
            $totalCount += $data['count'];
        }
        $overallAverage = $totalCount > 0 ? round($totalScore / $totalCount, 1) : 0;
        
        // Find highest grade and its subject
        $highestGrade = 0;
        $highestSubject = '';
        foreach ($subjectGrades as $subject => $data) {
            foreach ($data['grades'] as $grade) {
                if ($grade->score > $highestGrade) {
                    $highestGrade = $grade->score;
                    $highestSubject = $subject;
                }
            }
        }
        
        $totalAssessments = $grades->count();
        
        return view('student.grades', compact(
            'subjectGrades',
            'overallAverage',
            'highestGrade',
            'highestSubject',
            'totalAssessments'
        ));
    }
}