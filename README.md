# Cuadito App

-   Initial description of the app here

### Development Setup

1. Create .env file (duplicate the .env.example file)
2. Create database named **cuadito**
3. Change the following .env variables:
   **DB_DATABASE=cuadito**
   **DB*USERNAME=\_Your username***
   **DB*PASSWORD=\_DB password***
4. Run the following commands

```sh
composer install
php artisan migrate:fresh --seed
```

5. Viola you can now navigate to http://localhost/ to view the app!

### Tech Stack

-   [Laravel](https://laravel.com/)

### Resetting Data

You can reset the data by running the following command:

```sh
php artisan migrate:fresh --seed
```

### Jobs & Queues

The app uses **Jobs** for the following background tasks:

1. Sending notifications for the bidders of a project (if the project is closed).

To continue please run the worker command:

```sh
php artisan queue:work
```
