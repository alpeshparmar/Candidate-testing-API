<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Services\CandidateTestingApiClient;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $apiClient;

    public function __construct(CandidateTestingApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Display the form for creating a new book.
     *
     */
    public function create($authorId)
    {
        return view('books.create', compact('authorId'));
    }

    /**
     * Store a newly created book in the external API.
     *
     */
    public function store(StoreBookRequest $request)
    {
        $bookData = [
            'author' => [
                'id' => $request->input('author_id'),
            ],
            'title' => $request->input('title'),
            'release_date' => $request->input('release_date'),
            'description' => $request->input('description'),
            'isbn' => $request->input('isbn'),
            'format' => $request->input('format'),
            'number_of_pages' => (int) $request->input('number_of_pages'),
        ];

        $response = $this->apiClient->createBook($bookData);
        if ($response) {
            return redirect()->route('authors.show', $request->input('author_id'))->with('success', 'Book added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add the book.');
        }
    }

    /**
     * Remove the specified book from the external API.
     *
     */
    public function destroy($id)
    {
        $response = $this->apiClient->deleteBook($id);

        if ($response) {
            return redirect()->back()->with('success', 'Book deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the book.');
        }
    }
}
