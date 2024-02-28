<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function registerPost(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Register success');
    }

    public function loginPost(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Login success');
        }

        return back()->with('error', 'Email or Password Incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
