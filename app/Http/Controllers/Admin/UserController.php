<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(8);

        $classrooms = Classroom::all();
        $subjects = Subject::all();

        return view('admin.usersPage', compact('users', 'classrooms', 'subjects'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Student,Teacher,Admin',
            'status' => 'required|in:Active,Not Active',
            'gender' => 'required|in:Male,Female',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'subject_id' => 'nullable|exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.usersPage')
                ->withErrors($validator)
                ->withInput();
        }

        $userData = $validator->validated();

        $generatedUsername = User::generateUsername(
            $userData['first_name'], 
            $userData['last_name']
        );

        if (!$generatedUsername || User::where('username', $generatedUsername)->exists()) {
            return redirect()->route('admin.usersPage')
                ->withErrors(['username' => 'Unable to generate a unique username. Please try again.'])
                ->withInput();
        }

        $userData['username'] = $generatedUsername;
        $userData['password'] = bcrypt($generatedUsername);

        $user = User::create($userData);

        if ($user->role === 'Teacher') {
            if ($request->filled('classroom_id')) {
                DB::table('classroom_teacher')->insert([
                    'teacher_id' => $user->id,
                    'classroom_id' => $request->classroom_id,
                ]);
            }
            if ($request->filled('subject_id')) {
                DB::table('subject_teacher')->insert([
                    'teacher_id' => $user->id,
                    'subject_id' => $request->subject_id,
                ]);
            }
        }

        return redirect()->route('admin.usersPage');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:Student,Teacher,Admin',
            'status' => 'required|in:Active,Not Active',
            'gender' => 'required|in:Male,Female',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'subject_id' => 'nullable|exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.usersPage')
                ->withErrors($validator)
                ->withInput();
        }

        $userData = $validator->validated();

        $user->update($userData);

        if ($user->role === 'Teacher') {
            DB::table('classroom_teacher')
                ->updateOrInsert(
                    ['teacher_id' => $user->id],
                    ['classroom_id' => $request->classroom_id]
                );

            // Subject
            DB::table('subject_teacher')
                ->updateOrInsert(
                    ['teacher_id' => $user->id],
                    ['subject_id' => $request->subject_id]
                );
        } else {
            DB::table('classroom_teacher')->where('teacher_id', $user->id)->delete();
            DB::table('subject_teacher')->where('teacher_id', $user->id)->delete();
        }

        return redirect()->route('admin.usersPage');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        DB::table('classroom_teacher')->where('teacher_id', $id)->delete();
        DB::table('subject_teacher')->where('teacher_id', $id)->delete();

        return redirect()->route('admin.usersPage');
    }

    public function getTeacherAssignments($id)
    {
        $classroomId = DB::table('classroom_teacher')->where('teacher_id', $id)->value('classroom_id');
        $subjectId = DB::table('subject_teacher')->where('teacher_id', $id)->value('subject_id');

        return response()->json([
            'classroom_id' => $classroomId,
            'subject_id' => $subjectId,
        ]);
    }
}