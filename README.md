# KMS


## Required programs

* PHP version > 7.1](https://www.php.net/downloads.php)
* Composer](https://getcomposer.org/download/)
* Xampp or any server


## Installation

* git clone https://github.com/YosephHailu/KMS

* cd KMS

* composer install

* php artisan key:generate

* Create a database and inform .env https://laravel.com/docs/5.7/configuration

###### To create and populate tables

* php artisan migrate --seed

* php artisan serve or if you have xamp open https://localhost/KMS/public



Don't forget to add php to your environment variable otherwise the php commands will not work properly https://john-dugan.com/add-php-windows-path-variable/

