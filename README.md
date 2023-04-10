Laravel Sanctum API to Manage Notes using Docker
================================================

This repository contains a Laravel Sanctum API to manage notes, along with a Docker configuration to run the application in a containerized environment.

Requirements
------------

Before you start, make sure you have the following software installed on your system:

*   Docker
*   Docker Compose

Getting Started
---------------

To get started with this project, follow these steps:

1.  Clone the repository:

bashCopy code

`git clone https://github.com/your-username/laravel-sanctum-api.git cd laravel-sanctum-api`

2.  Copy the `.env.example` file to `.env`:

bashCopy code

`cp .env.example .env`

3.  Generate the application key:

luaCopy code

`docker-compose run --rm app php artisan key:generate`

4.  Install the project dependencies:

arduinoCopy code

`docker-compose run --rm app composer install`

5.  Run the migrations:

luaCopy code

`docker-compose run --rm app php artisan migrate`

6.  Start the application:

Copy code

`docker-compose up -d`

7.  Access the application at [http://localhost:8000](http://localhost:8000)

API Endpoints
-------------

The following endpoints are available in the API:

*   `POST /api/register`: Register a new user
*   `POST /api/login`: Log in with an existing user
*   `GET /api/notes`: Get a list of all notes for the authenticated user
*   `GET /api/note/{id}`: Get a single note by ID for the authenticated user
*   `POST /api/note`: Create a new note for the authenticated user
*   `PUT /api/note/{id}`: Update a note by ID for the authenticated user
*   `DELETE /api/note/{id}`: Delete a note by ID for the authenticated user

Running Tests
-------------

To run the application tests, use the following command:

bashCopy code

`docker-compose run --rm app php artisan test`

Contributing
------------

If you would like to contribute to this project, please follow these steps:

1.  Fork the repository
2.  Create a new branch
3.  Make your changes and commit them
4.  Push your changes to your fork
5.  Submit a pull request

License
-------

This project is licensed under the MIT License. See the `LICENSE` file for more information.
