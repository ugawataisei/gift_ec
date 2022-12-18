<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Append Composer Package

- [laravel/breeze](https://readouble.com/laravel/9.x/ja/starter-kits.html).
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar).
- [intervention/image](https://image.intervention.io/v2).
- [laravelcollective/html](https://laravelcollective.com/) 
- [stripe/stripe-php](https://stripe.com/jp).

## Append NodeModule Package

- [flowbite](https://flowbite.com/docs/getting-started/introduction/).
- [jquery](https://jquery.com/).
- [select2](https://select2.org/).
- [swiper](https://swiperjs.com/)

## Develop Environment

[MAMP](https://www.mamp.info/en/downloads/) or Docker (php ver 8.0 | Mysql5.7)

## Directory Structure

```php
gift_ec/
        ┣app/
            └ Console/
            └ Consts/ #define const
            └ Exceptions/
            └ Http/
                  └ Actions/ #Single controller
                  └ Requests/ #validation check
            └ Jobs/
            └ Mail/
            └ Models/
            └ Providers/
            └ Services/ #main controller process
            └ View/
        ┣bootstrap
        ┣config #setting
        ┣database
        ┣public
        ┣resources
                  └ css/
                  └ js/ 
                  └ lang/ #lang
                  └ views/ #blade file      
        ┣routes #define controller route
        ┣storage
        ┣tests #process test
```

##  Infrastructure

only local environment

## Start Project

git clone this project your local environment

```php
git clone https://github.com/ugawataisei/gift_ec.git
```

write .env file　your own environment 
```php
#.env file

#database option
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

#stripe option
#please create stripe account
STRIPE_PUBLIC_KEY="PUBLIC_KEY"
STRIPE_SECRET_KEY="SECRET_KEY"

#mailtrap option
#please create mailtrap account 
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=hogehoge
MAIL_PASSWORD=hogehoge
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

run command first after clone this project

```php
composer install
npm install 
npm run development #css and js compile
```

run command your local environment
```php
php artisan:storage link
php artisan migrate:refresh --seed
php artisan serve #start php server
```

login 

```php
#admin
url : 'app-url/admin/login'
user : admin@admin.admin
pass : password

#shop owner
url : 'app-url/owner/login'
user : owner1@owner.owner
pass : password

#user
url : 'app-url/owner/login'
user : user1@user.user
pass : password
```
