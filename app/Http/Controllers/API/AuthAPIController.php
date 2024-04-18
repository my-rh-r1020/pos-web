<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseResponseController as BaseResponseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAPIController extends BaseResponseController
{
    /**
     * API Register
     */
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'fullname' => 'required|string|max:100|min:3|unique:users,fullname',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        $credentials['role'] = 'user';

        if ($credentials) {
            $user = User::create($credentials);
            $success['token'] = $user->createToken('api_token')->plainTextToken;
            $success['fullname'] = $user->fullname;

            return $this->sendResponse($success, 'Registration Successful');
        } else {
            return $this->sendError('Validation Error', ['failed' => 'Registration Failed!']);
        }
    }

    /**
     * API Login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('api_token')->plainTextToken;
            $success['fullname'] = $user->fullname;
            $success['role'] = $user->role;
            $success['email'] = $user->email;

            return $this->sendResponse($success, 'Login Success');
        } else {
            return $this->sendError('Unauthorized', ['failed' => 'Login Failed! Please Try Again']);
        }
    }

    /**
     * API Logout
     */
    public function logout(Request $request)
    {
        $success = $request->user()->tokens()->delete();
        return $this->sendResponse($success, 'Logout Success');
    }
}
