<?php

namespace App\Http\Controllers\NonAPI;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.dashboard');
    }
}
