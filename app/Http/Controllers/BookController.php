<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibBook;
use App\Http\Controllers\MessagesController;


class BookController extends Controller
{
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
        $books = LibBook::BookbyId($id);

        // Return the response
        return response()->json($books);
    }

    public function editBook(Request $request, $id)
    {
        // Call the shelf_name function from the LibBook model
        $book = LibBook::findOrFail($id);
        $authors = LibAuthor::all();

        // Return the response
        return response()->json(['Book' => $book, 'Authors' => $authors]);
    }

    public function update(Request $request, $id)
    {
        $book = LibBook::findOrFail($id);
        // Update book details

        // Sync authors
        $book->authors()->sync($request->input('authors', []));
        return redirect()->route('dashboard.index')->with('success', 'Book updated successfully');
    }

    public function create(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'shelf_id' => 'required',
            'book_number' => 'required',
            // Add other validation rules as needed
        ]);

        // Check for duplicates
        $duplicate = LibBook::where('shelf_id', $request->shelf_id)
            ->where('book_number', $request->book_number)
            ->exists();
        if ($duplicate) {
            return response()->json(['error' => 'Duplicate book.'], 422);
        }

        // Create new book
        $book = new LibBook();
        $book->shelf_id = $request->shelf_id;
        $book->book_number = $request->book_number;
        // Add other fields as needed
        $book->save();

        // Get the newly created book's details
        $lastBook = LibBook::latest()->first();

        // Perform post-processing here
        // You can access $lastBook->id to get the book_id

        return response()->json($lastBook, 201);
    }

    public function getLastBookDetails()
    {
        $lastBook = LibBook::latest()->first();
        return response()->json($lastBook);
    }

    public function checkForDuplicates(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'shelf_number_id' => 'required',
            'sefer_number' => 'required',
        ]);

        // Check for duplicates
        $duplicate = LibBook::where('shelf_id', $request->shelf_id)
            ->where('book_number', $request->book_number)
            ->exists();

        return response()->json(['duplicate' => $duplicate]);
    }


    public function getNextAvailableSeferNumber($shelfId)
    {
        $maxSeferNumber = LibBook::where('shelf_id', $shelfId)
            ->max('sefer_number');

        // If there are no books on the shelf, start with sefer number 1
        if ($maxSeferNumber === null) {
            return response()->json(['next_available_sefer_number' => 1]);
        }

        // Check if there are any gaps in the sefer numbers
        for ($i = 1; $i <= $maxSeferNumber; $i++) {
            $exists = LibBook::where('shelf_id', $shelfId)
                ->where('sefer_number', $i)
                ->exists();
            if (!$exists) {
                return response()->json(['next_available_sefer_number' => $i]);
            }
        }

        // If all sefer numbers are taken, return the next sequential number
        return response()->json(['next_available_sefer_number' => $maxSeferNumber + 1]);
    }

    public function checkSeferNumberExists($shelfId, $seferNumber)
    {
        $exists = LibBook::where('shelf_id', $shelfId)
            ->where('sefer_number', $seferNumber)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Sefer number found on the shelf.'], 200);
        } else {
            return response()->json(['message' => 'Sefer number not found on the shelf.'], 404);
        }
    }

    public function getNewBookRefNumber()
    {
        // Get the latest BookRef number
        $latestBookRef = LibBook::max('book_reference_id');

        // Generate the new BookRef number
        $newBookRef = $latestBookRef + 1;

        return response()->json(['new_book_reference_id' => $newBookRef]);
    }

    public function updateBookTitle(Request $request, $bookId, $titleId)
    {
        $book = LibBook::findOrFail($bookId);
        $title = $book->titles()->findOrFail($titleId);

        // Validate request data
        $validatedData = $request->validate([
            'book_title' => 'required',
            // Add other validation rules as needed
        ]);

        // Update title details
        $title->update([
            'book_title' => $request->book_title,
            'book_subtitle' => $request->book_subtitle,
            'book_sub_subtitle' => $request->book_sub_subtitle,
        ]);

        return response()->json($title);
    }

    public function addBookTitle(Request $request, $bookId)
    {
        $book = LibBook::findOrFail($bookId);

        // Validate request data
        $validatedData = $request->validate([
            'book_title' => 'required',
            // Add other validation rules as needed
        ]);

        // Create a new title for the book
        $title = new LibTitle();
        $title->book_title = $request->book_title;
        $title->book_subtitle = $request->book_subtitle;
        $title->book_sub_subtitle = $request->book_sub_subtitle;

        // Save the title
        $book->titles()->save($title);

        return response()->json($title, 201);
    }

    public function getBookTitles($bookId)
    {
        $book = LibBook::findOrFail($bookId);
        $titles = $book->titles()->get();

        return response()->json($titles);
    }

}

