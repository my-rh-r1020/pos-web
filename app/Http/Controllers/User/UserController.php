<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::orderBy('id', 'desc')->paginate(10);
        $users = User::orderBy('id', 'desc')->when(
            $request->input('search'),
            fn ($query, $search) => $query->where('fullname', 'like', '%' . $search . '%')
        )->paginate(10)->withQueryString();
        return view('pages.user.data.user_main', compact('users'));
    }
}
