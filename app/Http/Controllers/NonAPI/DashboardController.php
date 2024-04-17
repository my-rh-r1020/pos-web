<?php

namespace App\Http\Controllers\NonAPI;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $users = User::count();
        return view('pages.dashboard.dashboard', compact('products', 'users'));
    }
}
