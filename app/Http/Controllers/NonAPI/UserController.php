<?php

namespace App\Http\Controllers\NonAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $users = User::when(
                $request->input('search'),
                fn ($query, $search) => $query->where('fullname', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')
            )->orderBy('id', 'desc')->paginate(10)->withQueryString();
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);
        }

        return view('pages.dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            if ($avatarImg = $request->file('avatar')) {
                $imageName = date('YmdHis') . "." . $avatarImg->getClientOriginalExtension();
                $avatarImg->storeAs('profile-image', $imageName);
                $data['avatar'] = $imageName;
            } else {
                unset($data['avatar']);
            }

            $user->update($data);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);
        }

        return redirect()->route('users.index')->with('success', 'Profile successful updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
