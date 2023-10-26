# Laravel with FullCalendar.io plugin

## Overview
This is a basic calendar application built using [Laravel 10](https://laravel.com/) and [FullCalendar](https://fullcalendar.io) 
The calendar displays onetime and recurring appointments with the client's name and the business hours.
The user can register one time appointments selecting the timeslot. 
The selected timeslot is validated in the backend before getting saved to the database.

## Requirements

- PHP
- Composer
- PostgreSQL
- npm


## Installation

Please check the official Laravel installation guide for server requirements before you start: [Official Documentation](https://laravel.com/docs/10.x)

Clone the repository, switch to the repo folder and install all the dependencies using composer:
```
git clone git@github.com:Hladgerd/appointment-booker.git
cd appointment-booker
composer install
```

Copy the .env.example file:
```
cp .env.example .env
```

Add your pgsql database credentials in .env file:
```
DB_DATABASE=<your-DB-name>
DB_USERNAME=<your-DB-username>
DB_PASSWORD=<your-DB-password>
```

Run database migration and seed sample data:
```
php artisan migrate --seed
```

Start the local development server
```
php artisan serve
```
You can now access the server at http://localhost:8000

**TL;DR command list**
```
git clone git@github.com:Hladgerd/appointment-booker.git
cd appointment-booker
composer install
cp .env.example .env
DB_DATABASE=<your-DB-name>
DB_USERNAME=<your-DB-username>
DB_PASSWORD=<your-DB-password>
php artisan migrate --seed
php artisan serve
```


## Testing instructions
Open terminal in project's folder and run below command:
```
php artisan test
```
**Run tests with coverage**  
In order to run the tests with coverage, make sure that Xdebug's coverage mode has been set.
(Find instructions [here](https://dev.to/arielmejiadev/set-xdebug-coverage-mode-2d9g) how to do it)

Open the project in a terminal and run:
```
php artisan test --coverage
```
