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
    public function ByShelfname(Request $request, $shelf_name)
    {
        // Call the shelf_name function from the LibBook model
        $books = LibBook::BooksbyShelfname($shelf_name);

        // Return the response
        return response()->json($books);
    }

    public function ById(Request $request, $id)
    {
        // Call the shelf_name function from the LibBook model
        $books = LibBook::BookbyId($shelf_name);

        // Return the response
        return response()->json($books);
    }
}

