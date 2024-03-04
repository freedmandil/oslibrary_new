<?php

namespace App\Http\Controllers;

use App\Models\LibBook;
use Illuminate\Http\Request;
use App\Models\TaxTopic;
use App\Models\TaxCategory;
use App\Models\TaxSubcat;
use App\Models\TaxGroup;

class TaxonomyController extends Controller
{
    //
    public function createTopic(Request $request)
    {
        // Assuming the whole JSON object matches the TaxTopic model's attributes
        $validatedData = $request->validate([
            // Validate the whole structure as needed
            'name' => 'required|string|max:255', // Example validation
            // Add validations for other attributes
        ]);

        $topic = TaxTopic::create($validatedData);

        return response()->json($topic, 201); // 201 status code for created resource
    }

    public function updateTopic(Request $request, $bookId, $topicId)
    {
        $book = LibBook::findOrFail($bookId);
        $topic = $book->tax_topic()->findOrFail($topicId);

        // Validate request data
        $validatedData = $request->validate([
            'topic_name' => 'required',
            // Add other validation rules as needed
        ]);

        // Update topic details
        $topic->update([
            'topic_name' => $request->topic_name,
            // Update additional fields as needed
        ]);

        return response()->json($topic);
    }
}
