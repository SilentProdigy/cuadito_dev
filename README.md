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

### Mailgun Environment Setup

Put the following lines on the **.env** file:

```sh
   MAIL_DRIVER=mailgun
   MAIL_HOST=smtp.mailgun.org
   MAIL_PORT=587
   MAIL_USERNAME=postmaster@sandboxc97f3b1dc7dc4ee0af2f50effd22dd40.mailgun.org
   MAIL_PASSWORD=f6762319807907b6885b24a76356ee09-1b3a03f6-10864e7a
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=briancalmadevacc@gmail.com
   MAIL_FROM_NAME="${APP_NAME}"
```
