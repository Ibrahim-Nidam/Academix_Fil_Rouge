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

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        $fileType = $file->getClientMimeType();
        
        $path = $file->store('resources', 'public');

        $resource = Resource::create([
            'title' => $request->title,
            'teacher_id' => Auth::id(),
            'file_path' => $path,
            'file_name' => $fileName,
            'file_type' => $fileType,
            'file_size' => $this->formatSize($fileSize),
            'description' => $request->description,
        ]);

        if ($request->tags) {
            $tagNames = array_map('trim', explode(',', $request->tags));
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    Tag::create([
                        'resource_id' => $resource->id,
                        'tag_name' => $tagName
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'resource' => $resource,
            'message' => 'Resource uploaded successfully'
        ]);
    }
    
    private function formatSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public function show($id)
    {
        $resource = Resource::with(['tags', 'classrooms'])->findOrFail($id);
        
        return response()->json($resource);
    }

    public function update(Request $request, $id)
    {
        $resource = Resource::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $resource->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->tags) {
            Tag::where('resource_id', $resource->id)->delete();
            
            $tagNames = array_map('trim', explode(',', $request->tags));
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    Tag::create([
                        'resource_id' => $resource->id,
                        'tag_name' => $tagName
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'resource' => $resource,
            'message' => 'Resource updated successfully'
        ]);
    }


}