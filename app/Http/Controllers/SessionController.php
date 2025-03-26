<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function login(){
        $validation = request()->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $credantials = filter_var($validation['login'], FILTER_VALIDATE_EMAIL) 
                        ? ['email' => $validation['login'], 'password' => $validation['password']]
                        : ['username' => $validation['login'], 'password' => $validation['password']];

                        // dd($credantials);
        if(!Auth::attempt($credantials)){
            throw ValidationException::withMessages([
                'login' => 'The provided credentials do not match'
            ]);
        }

        request()->session()->regenerate();
        $role = Auth::user()->role;

        return redirect($role . '/dashboard');
    }
}
