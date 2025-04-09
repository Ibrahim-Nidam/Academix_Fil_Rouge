<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

        return view('admin.usersPage', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Student,Teacher,Admin',
            'status' => 'required|in:Active,Not Active',
            'gender' => 'required|in:Male,Female'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.usersPage')
                ->withErrors($validator)
                ->withInput();
        }

        $userData = $validator->validated();
        
        $userData['username'] = User::generateUsername(
            $userData['first_name'], 
            $userData['last_name']
        );

        $userData['password'] = bcrypt($userData['username']);

        User::create($userData);

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
            'gender' => 'required|in:Male,Female'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.usersPage')
                ->withErrors($validator)
                ->withInput();
        }

        $userData = $validator->validated();

        $user->update($userData);

        return redirect()->route('admin.usersPage');
    }

}