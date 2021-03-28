<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="250">
    </a>
</p>

# Laravel 8 Starter
Simple laravel 8 project

## Function List

* [x] User Migrate and Seeder
* [x] Auth Login
* [x] Auth Register
* [x] Auth Forgot Password

## Installation

* clone this project `git clone https://github.com/adiyansahcode/laravel-crud.git`
* Create .env file `cp .env.example .env`
* edit config database and mail in .env file
* Run composer `composer install`
* clean cache, create key and create storage
```
php artisan optimize:clear
php artisan key:generate
php artisan storage:link
```
* run Migration and Seeder `php artisan migrate:fresh --seed`
* run server `php artisan serve --port=8080`
* done, just try run your project in browser to `http://127.0.0.1:8080`
* default user login
```
username : admin
password : admin
```
