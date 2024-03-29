<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|min:5',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login Success');
        }

        return back()->with('failed', 'Login failed');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function registerProcess(Request $request)
    {
        $credentials = $request->validate([
            'fullname' => 'required|string|max:100|min:3|unique:users,fullname',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        $credentials['role'] = 'user';

        User::create($credentials);

        return redirect('/')->with('success', 'Registration Successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout Success');
    }
}
