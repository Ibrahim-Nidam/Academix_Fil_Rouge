<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_assignment_id',
        'student_id',
        'score',
        'comment'
    ];

    public function examAssignment()
    {
        return $this->belongsTo(ExamAssignment::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}