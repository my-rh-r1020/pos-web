<?php

namespace App\Http\Controllers\NonAPI;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when(
            $request->input('search'),
            fn ($query, $search) => $query->where('fullname', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')
        )->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('pages.dashboard.users.index', compact('users'));
    }
}
