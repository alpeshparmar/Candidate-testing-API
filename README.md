1. Clone the repository:

   git clone https://github.com/alpeshparmar/Candidate-testing-API.git

2. Navigate to the project directory:

    cd Candidate-testing-API

3. Install the dependencies:

    composer install

4. Configure your database connection in the .env file.

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=YOUR_DATABASE_NAME
    DB_USERNAME=YOUR_DATABASE_USER_NAME
    DB_PASSWORD=YOUR_DATABASE_PASSWORD

    # Testing Purpose
    CANDIDATE_TESTING_API_URL=https://candidate-testing.com/api
    CANDIDATE_TESTING_API_EMAIL=ahsoka.tano@cscorp.com
    CANDIDATE_TESTING_API_PASSWORD=Kryze4President

5. Run the migrations:

    php artisan migrate

6. Start the server:

    php artisan serve

7. Use the following credentials to log in

    Email: ahsoka.tano@cscorp.com
    Password: Kryze4President

After Login Open the Dashboard 

1. Display Total Authors Count

    Show the total number of authors available in the system.

2. User Profile and Logout Options

    In the top right corner, display the user’s logo.
    Upon clicking the logo, provide a dropdown menu with options to view the user profile and log out.

3. Sidebar Navigation

    Include an "Authors" tab in the sidebar.
    This tab should redirect the user to the list of authors when clicked.

4. Author List Management

    Display a list of all authors with an option to view or remove each author.
    The "Remove" button should only be accessible if the selected author has no associated books.

5. Author Details Page

    The "View" button should redirect the user to the detailed view page of the selected author.
    This page should display the author’s details along with a list of their books.

6. Book Management Functionality

    Implement functionality to create new books associated with the selected author.
    Provide an option to remove books from the author’s list as needed.

7. Command for create Author

    In Main Path try with command :
    php artisan author:add author:add {first_name} {last_name} {birthday} {biography} {gender} {place_of_birth}

    Example :
    php artisan author:add "Test" "User" "07-12-2000" "An author biography" "male" "New York"



