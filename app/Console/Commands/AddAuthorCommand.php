<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CandidateTestingApiClient;

class AddAuthorCommand extends Command
{
    protected $signature = 'author:add {first_name} {last_name} {birthday} {biography} {gender} {place_of_birth}';
    protected $description = 'Add a new author to the Candidate Testing API';

    protected $apiClient;

    public function __construct(CandidateTestingApiClient $apiClient)
    {
        parent::__construct();
        $this->apiClient = $apiClient;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userData = $this->apiClient->login(env('CANDIDATE_TESTING_API_EMAIL'), env('CANDIDATE_TESTING_API_PASSWORD'));
        if($userData){
            $firstName = $this->argument('first_name');
            $lastName = $this->argument('last_name');
            $birthdayInput = $this->argument('birthday');
            $biography = $this->argument('biography');
            $gender = $this->argument('gender');
            $placeOfBirth = $this->argument('place_of_birth');
            $apiToken = $userData['token_key'];

            try {
                $birthday = \DateTime::createFromFormat('d-m-Y', $birthdayInput)->format('Y-m-d\TH:i:s.v\Z');
            } catch (\Exception $e) {
                $this->error('Invalid date format. Please use DD-MM-YYYY.');
                return 1;
            }

            $authorData = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'birthday' => $birthday,
                'biography' => $biography,
                'gender' => $gender,
                'place_of_birth' => $placeOfBirth,
            ];

            $response = $this->apiClient->addAuthor($authorData, $apiToken);

            if ($response) {
                $this->info('Author added successfully!');
            } else {
                $this->error('Failed to add the author. Please try again.');
            }
        } else {
            $this->error('Access Token Failed');
            return 1;
        }

        return 0;
    }
}
