<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CandidateTestingApiClient
{
    protected $client;
    protected $baseUrl;
    protected $commandClient;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('CANDIDATE_TESTING_API_URL');
        $this->commandClient = new Client([
            'base_uri' => $this->baseUrl,
        ]);
    }

    /**
     * Logs in a user and stores the API token and user data in the session.
     *
     * @param string $email The user's email address.
     * @param string $password The user's password.
     * @return array|null Returns user data including the API token on success, or null on failure.
     */
    public function login($email, $password)
    {
        try {
            $response = $this->client->post("{$this->baseUrl}/v2/token", [
                'headers' => [
                    'accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['token_key'])) {
                $user = $data['user'];
                session(
                    [
                        'api_token' => $data['token_key'],
                        'user' => [
                            'id' => $user['id'],
                            'email' => $user['email'],
                            'first_name' => $user['first_name'],
                            'last_name' => $user['last_name'],
                            'gender' => $user['gender'],
                            'active' => $user['active'],
                            'email_confirmed' => $user['email_confirmed'],
                        ]
                    ]
                );
                return $data;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Login failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Fetches a list of authors using the stored API token for authentication.
     *
     * @return array|null Returns the authors data on success, or null on failure.
     */

    public function getAuthors()
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/v2/authors", [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('api_token'),
                    'Accept' => 'application/json',
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Failed to fetch authors: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Fetches a specific author's details by ID using the stored API token for authentication.
     *
     * @param int $id The author's ID.
     * @return array|null Returns the author data on success, or null on failure.
     */
    public function getAuthor($id)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/v2/authors/{$id}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('api_token'),
                    'Accept' => 'application/json',
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Failed to fetch author: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Deletes a specific author by ID using the stored API token for authentication.
     *
     * @param int $id The author's ID.
     * @return bool Returns true on successful deletion, or false on failure.
     */
    public function deleteAuthor($id)
    {
        try {
            $response = $this->client->delete("{$this->baseUrl}/v2/authors/{$id}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('api_token'),
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 204) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Failed to delete author: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Creates a new book using the provided data and the stored API token for authentication.
     *
     * @param array $bookData The data for the new book.
     * @return bool Returns true on successful book creation, or false on failure.
     */
    public function createBook(array $bookData)
    {
        try {
            $response = $this->client->post("{$this->baseUrl}/v2/books", [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('api_token'),
                    'Accept' => 'application/json',
                ],
                'json' => $bookData,
            ]);
            if ($response->getStatusCode() === 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Failed to create book: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Deletes a specific book by ID using the stored API token for authentication.
     *
     * @param int $id The book's ID.
     * @return bool Returns true on successful deletion, or false on failure.
     */
    public function deleteBook($id)
    {
        try {
            $response = $this->client->delete("{$this->baseUrl}/v2/books/{$id}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('api_token'),
                    'Accept' => 'application/json',
                ],
            ]);
            if ($response->getStatusCode() === 204) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Failed to delete book: ' . $e->getMessage());
            return false;
        }
    }

    public function addAuthor(array $authorData, $apiToken)
    {
        // Call the API endpoint to add an author
        $response = $this->commandClient->post('/api/v2/authors', [
            'json' => $authorData,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiToken, // Use the passed API token
            ],
        ]);
        // Check if the response is successful
        if ($response->getStatusCode() === 200) { // Assuming 201 is the success code
            return json_decode($response->getBody(), true);
        }

        return false; // Return false if the request failed
    }
}
