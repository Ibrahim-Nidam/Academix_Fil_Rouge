<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function updateProfile(Request $request){
        $user = Auth::user();

        $validation = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'date_of_birth' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        if($request->filled('additional_email')){
            $validation['additional_email'] = [
                'email', Rule::unique('users')->ignore($user->id)
            ];
            $validation['confirm_additional_email'] = [
                'required_with:additional_email', 'same:additional_email'
            ];
        }

        if($request->hasFile('profile_image')){
            $image = Validator::make($request->only('profile_image'), [
                'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if($image->fails()){
                return redirect()->back();
            }
        }

        $validation = $request->validate($validation, [
            'confirm_additional_email.same' => 'The additional email confirmation does not match'
        ]);

        if($request->hasFile('profile_image')){
            $profileImage = $request->file('profile_image');

            if($user->profile_image){
                $oldImageFullPath = storage_path('app/public/' . $user->profile_image);

                if(file_exists($oldImageFullPath)){
                    unlink($oldImageFullPath);
                }
            }

            $image = $profileImage->store('profile_images', 'public');
            $validation['profile_image'] = $image;
        }

        $user->first_name = $validation['first_name'];
        $user->last_name = $validation['last_name'];
        $user->username = $validation['username'];
        $user->date_of_birth = $validation['date_of_birth'] ?? null;

        if(isset($validation['additional_email'])){
            $user->additional_email = $validation['additional_email'];
        }

        if(isset($validation['profile_image'])){
            $user->profile_image = $validation['profile_image'];
        }

        $user->save();

        return redirect()->back();
    }

    public function passwordUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'currentPassword' => 'required',
            'newPassword'     => 'required|min:6|max:12'
        ]);

        if (!Hash::check($request->input('currentPassword'), $user->password)) {
            return redirect()->back()->withErrors([
                'currentPassword' => 'The current password is incorrect.'
            ]);
        }

        $user->password = Hash::make($request->input('newPassword'));
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}