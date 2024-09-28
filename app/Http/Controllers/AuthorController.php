<?php

namespace App\Http\Controllers;

use App\Services\CandidateTestingApiClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthorController extends Controller
{
    protected $apiClient;

    public function __construct(CandidateTestingApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
 * Fetch the list of authors and check if each author has available books.
 *
 * @return \Illuminate\View\View
 */
    public function index()
    {
        $authors = $this->apiClient->getAuthors();
        $authorItems = $authors['items'] ?? [];

        foreach ($authorItems as &$authorItem) {
            $authorDetails = $this->apiClient->getAuthor($authorItem['id']);
            if ($authorDetails) {
                $authorItem['is_book_available'] = !empty($authorDetails['books']);
            } else {
                $authorItem['is_book_available'] = false;
            }
        }
        $authors['items'] = $authorItems;
        return view('authors.index', compact('authors'));
    }

    /**
     * Show details of a single author by ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $authorDetails = $this->apiClient->getAuthor($id);

        if (!$authorDetails) {
            return redirect()->route('authors.index')->with('error', 'Author not found.');
        }

        return view('authors.show', compact('authorDetails'));
    }

    /**
     * Delete an author by ID after ensuring the author has no related books.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $authorDetails = $this->apiClient->getAuthor($id);

        if (!$authorDetails) {
            return redirect()->back()->with('error', 'Author not found.');
        }

        if (!empty($authorDetails['books'])) {
            return redirect()->back()->with('error', 'Cannot delete author with related books.');
        }

        $response = $this->apiClient->deleteAuthor($id);

        if ($response) {
            return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the author.');
        }
    }
}
