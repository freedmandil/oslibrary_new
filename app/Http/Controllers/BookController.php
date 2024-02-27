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
            $books = LibBook::select(
                'lib_books.id',
                'lib_titles.book_title as title',
                'lib_books.book_edition AS edition',
                'lib_books.book_notes AS notes',
                'lib_books.book_type AS type',
                'tax_topics.name_en as topic_en',
                'tax_topics.name_he as topic_he',
                'lib_books.book_class_ref AS classRef',
                'lib_books.book_class_number AS classNumber',
                'lib_books.book_reference_id AS referenceId',
                'lib_books.sefer_number as seferNumber',
                'lib_books.barcode as barcode',
                'lib_books.loc_assignment_id AS assignmentId',
                'lib_books.date_updated as dateUpdated',
                'lib_publishers.name_en AS publisher_en',
                'lib_publishers.name_he AS publisher_he',
                'sys_languages.name_lan AS language',
                'loc_shelfnames.name AS shelfNumber',
                'loc_locations.name_en as assignment_en',
                'loc_locations.name_he as assignment_he',
                'lib_authors.last_name as author_last',
                'lib_authors.first_name as author_first',

            )
            ->join('loc_shelfnames', 'lib_books.shelf_number_id', '=', 'loc_shelfnames.id')
            ->leftJoin('lib_titles', 'lib_books.book_title_id', '=', 'lib_titles.id')
            ->leftJoin('lib_publishers', 'lib_books.publisher_id', '=', 'lib_publishers.id')
            ->leftJoin('sys_languages', 'lib_books.language_id', '=', 'sys_languages.id')
            ->leftJoin('tax_topics', 'lib_books.book_topic_id', '=', 'tax_topics.id')
            ->leftJoin('lib_authorbook_relationship', 'lib_books.id', '=', 'lib_authorbook_relationship.book_id')
            ->leftJoin('lib_authors', 'lib_authorbook_relationship.author_id', '=', 'lib_authors.id')
            ->leftJoin('loc_assignments', 'lib_books.loc_assignment_id', '=', 'loc_assignments.id')
            ->leftJoin('loc_locations', 'loc_assignments.location_id', '=', 'loc_locations.id')
            ->leftJoin('sys_colors', 'loc_assignments.color_id', '=', 'sys_colors.id')
            ->where('loc_shelfnames.name', $shelf_name)
            ->get();

        return response()->json($books);
    }
}

