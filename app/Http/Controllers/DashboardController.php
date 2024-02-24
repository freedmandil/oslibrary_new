<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user
        $usr_cat = $user->usr_cat; // Access the user's profile
        switch ($usr_cat->category_name) {
            case 'student':
            case 'staff': return view('dashboard.index', compact('user'));
            case 'admin': return view('dashboard.admin', compact('user'));
            case 'super_admin': return view('dashboard.super_admin', compact('user'));
            default: return view('home', compact('user'));
        }
    }
}
