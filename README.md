laravel-rest-api
============================

Simple Rest Api with Laravel Framework 7.4.0

Install with Composer
-------------------
    composer create-project --prefer-dist laravel/laravel laravel-rest-api

Set the application key
-------------------
    php artisan key:generate

Run migrate
-------------------
    php artisan migrate

Create users
-------------------
    php artisan db:seed

Create jwt secret
-------------------
    php artisan jwt:secret

Run tests
-------------------
    php artisan test
