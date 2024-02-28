<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LibBook;
use App\Models\LocShelfname;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user
        $usr_cat = $user->usr_cat; // Access the user's profile
        $books = LibBook::all(); // Retrieve all books
        $books = LibBook::with(['lib_author', 'lib_titles', 'lib_publisher', 'tax_subcategory', 'tax_category', 'tax_topic', 'tax_group', 'sys_language', 'loc_assignment', 'loc_assignment.loc_location'])->get();
        $shelfnumbers = LocShelfname::pluck('name', 'id');


        switch ($usr_cat->category_name) {
            case 'student':
            case 'staff': return view('dashboard.index', compact('user','books', 'shelfnumbers'));
            case 'admin': return view('dashboard.admin', compact('user','books', 'shelfnumbers'));
            case 'super_admin': return view('dashboard.admin', compact('user','books', 'shelfnumbers'));
            default: return view('home', compact('user','books', 'shelfnumbers'));
        }
    }
}

