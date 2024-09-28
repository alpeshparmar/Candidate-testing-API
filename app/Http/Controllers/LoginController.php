<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\CandidateTestingApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    protected $apiClient;

    public function __construct(CandidateTestingApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Show the login form for the application.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request for the application.
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $token = $this->apiClient->login($validatedData['email'], $validatedData['password']);

        if ($token) {
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Login failed.']);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Session::forget('api_token');
        Session::forget('user');

        $request->session()->invalidate();

        return redirect()->route('login.form')->with('success', 'Logged out successfully.');
    }
}
