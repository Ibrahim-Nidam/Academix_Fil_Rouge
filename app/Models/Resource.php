<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'teacher_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'description',
        'downloads'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_resource');
    }
}