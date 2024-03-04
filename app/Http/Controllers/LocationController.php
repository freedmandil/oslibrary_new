<?php

namespace App\Http\Controllers;

use App\Models\LibBook;
use App\Models\LocShelf;
use App\Models\LocLocation;
use App\Models\LocAssignment;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
    public function createShelf(Request $request)
    {
        // Assuming the whole JSON object matches the LocShelf model's attributes
        $validatedData = $request->validate([
            // Validate the whole structure as needed
            'location' => 'required|string|max:255', // Example validation
            // Add validations for other attributes
        ]);

        $shelf = LocShelf::create($validatedData);

        return response()->json($shelf, 201); // 201 status code for created resource
    }

    public function updateShelf(Request $request, $bookId, $shelfId)
    {
        $book = LibBook::findOrFail($bookId);
        $shelf = $book->loc_shelf()->findOrFail($shelfId);

        // Validate request data
        $validatedData = $request->validate([
            'shelf_location' => 'required',
            // Add other validation rules as needed
        ]);

        // Update shelf details
        $shelf->update([
            'shelf_location' => $request->shelf_location,
            // Update additional fields as needed
        ]);

        return response()->json($shelf);
    }
}
