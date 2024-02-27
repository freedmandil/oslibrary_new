<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibBook;

class BookController extends Controller
{
    public function handle(Request $request, $method, $param = null)
    {
        // Check if the method exists in the controller
        if (method_exists($this, $method)) {
            // Call the method dynamically
            return $this->{$method}($request, $param);
        } else {
            // Method not found, handle error or return response
            return response()->json(['error' => 'Method not found: {'.$method.'}' ], 404);
        }
    }
    public function shelf_name(Request $request, $shelf_name)
    {
        // Query books with the specified shelf name
        $books = LibBook::join('loc_shelfnames', 'shelf_number_id', '=', 'loc_shelfnames.id')
            ->where('loc_shelfnames.name', $shelf_name)
            ->get();

        return response()->json($books);
    }
}

