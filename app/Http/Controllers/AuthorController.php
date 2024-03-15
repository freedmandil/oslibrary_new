<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libAuthor;
use App\Models\libBook;
use App\Models\LibAuthorbookRelationship;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function getAuthorByBookId(Request $request, $book_id)
    {
        // Query books with the specified shelf name
        $author = libAuthor::select('*')->where('book_id', intval($book_id))->get();

        return $author ? response()->json($author) : json(['error'=>true]);
    }

    public function getBooksByAuthorId(Request $request, $author_id)
    {
        // Query books with the specified shelf name
        $books = libBook::select('*')->where('author_id', intval($author_id))->get();

        return $books ? response()->json($books) : json(['error'=>true]);
    }

    public function getAuthorBookRelationship(Request $request, $author_id, $book_id)
    {
        // Query books with the specified shelf name
        $relationship = LibAuthorbookRelationship::select('*')->where('author_id', intval($author_id))->where('book_id', intval($book_id))->get();

        return $relationship ? response()->json($relationship) : json(['error'=>true]);
    }

   public function getAuthors() {
        $authors = libAuthor::select('*')->orderBy('last_name', 'asc')->get();
        return $authors ? response()->json($authors) : json(['error'=>true]);
   }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => [
                'required',
                'max:255',
                function($attribute, $value, $fail) use ($request) {
                    // Check if an author with the same first_name, last_name, and optionally acronym exists
                    $exists = DB::table('lib_authors')
                        ->where('first_name', $request->first_name)
                        ->where('last_name', $request->last_name)
                        // Check acronym only if it's provided
                        ->when($request->filled('acronym'), function ($query) use ($request) {
                            return $query->where('acronym', $request->acronym);
                        })
                        ->exists();

                    if ($exists) {
                        $fail('An author with the same name and/or acronym already exists.');
                    }
                },
            ],
            'acronym' => 'sometimes|required|max:255|unique:lib_authors,acronym',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Proceed to create the author if validation passes
        $author = new LibAuthor();
        $author->prefix = $request->prefix;
        $author->first_name = $request->first_name;
        $author->middle_name = $request->middle_name;
        $author->last_name = $request->last_name;
        $author->acronym = $request->acronym;
        $author->suffix = $request->suffix;
        $author->nickname = $request->nickname;
        $author->save();

        return response()->json(['message' => 'Author created successfully', 'data' => $author], 201);
    }
}
