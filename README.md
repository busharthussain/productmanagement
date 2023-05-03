<p align="center">
    <h1 align="center">Product Management</h1>
</p>

The project was created while recording video "[Create Product Management System Using Laravel](https://youtu.be/D2xPWj-682E)"

## Installation package


Add the package in your composer.json by executing the command.

```
composer require bushart/productmanagement
```
### Config file

1. Add the service provider to `app/config/app.php`
```
bushart\productmanagement\ProductManagementServiceProvider::class,
```
## Configuration

### Publish configuration  files

Laravel 8.\*

```
php artisan vendor:publish --tag=config
```

#### Command 
Please run the below command in the project terminal to Generate the entire resource

```
php artisan productmanagement:admin
```
### Database

1. Migrate database table `php artisan migrate`


### Run Server

1. `php artisan serve` or Laravel Homestead
1. Visit `localhost:8000/dashboard` in your browser after `user authentication`.


