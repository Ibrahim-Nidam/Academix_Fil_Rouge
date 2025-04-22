<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\User;

class StudentResourceController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'Teacher')
            ->whereHas('resources')
            ->with(['resources' => function($query) {
                $query->with('tags');
                $query->orderBy('created_at', 'desc');
            }, 'subjects'])
            ->get();

        // group resources by grade level for each teacher
        foreach ($teachers as $teacher) {
            $groupedResources = [];
            
            foreach ($teacher->resources as $resource) {
                $grade = 'General';
            
                if (! isset($groupedResources[$grade])) {
                    $groupedResources[$grade] = [];
                }
            
                $groupedResources[$grade][] = $resource;
            }
            
            // Sort groups by grade level
            ksort($groupedResources);
            $teacher->groupedResources = $groupedResources;
        }

        return view('student.resources', compact('teachers'));
    }

    public function download($id)
    {
        $resource = Resource::findOrFail($id);
        $resource->increment('downloads');
        
        return response()->download(storage_path('app/public/' . $resource->file_path), $resource->file_name);
    }
}