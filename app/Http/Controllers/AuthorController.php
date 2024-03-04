<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libAuthor;
use App\Models\libBook;
use App\Models\LibAuthorbookRelationship;

class AuthorController extends Controller
{
    public function getAuthorByBookId(Request $request, $book_id)
    {
        // Query books with the specified shelf name
        $author = libAuthor::select('*')->where('book_id', intval($book_id))->get();

        return $author ? response()->json($author) : json(['error'=>true]);
    }


}
