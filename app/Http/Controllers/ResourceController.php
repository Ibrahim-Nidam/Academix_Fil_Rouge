<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::where('teacher_id', Auth::id())
                            ->with('tags')
                            ->get();
    
        if(request()->wantsJson()) {
            return response()->json($resources);
        }
    
        return view('teacher.resource', compact('resources'));
    }


}