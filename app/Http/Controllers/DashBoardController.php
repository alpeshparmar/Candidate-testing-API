<?php

namespace App\Http\Controllers;

use App\Services\CandidateTestingApiClient;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    protected $apiClient;

    public function __construct(CandidateTestingApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Display the dashboard view with the total count of authors.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {

        $authors = $this->apiClient->getAuthors();
        $authorsCount = $authors ? $authors['total_results'] : 0;
        return view('dashboard', compact('authorsCount'));
    }

    /**
     * Display the user's profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('profile');
    }
}
