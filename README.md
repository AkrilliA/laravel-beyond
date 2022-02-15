# Laravel Beyond

This package should help you with creating and managing a Laravel DDD Application. 
This package is heavily inspired by "Laravel beyond CRUD" from Spatie.

## Installation

Install laravel-beyond with composer

```bash
composer require --dev regnerisch/laravel-beyond
```

## Usage

You can easily set up a DDD application with `php artisan beyond:setup` after installation. You should only run this 
command on a freshly installed Laravel app, as it will delete files and rename things.

After you run `beyond:setup` you should execute `composer dump-autoload`. You can now make controllers, actions, models, etc. as you know it from Laravel:
```bash
php artisan beyond:make:action Users CreateUserAction
php artisan beyond:make:command UpdateUsersCommand
php artisan beyond:make:controller Users UserController
php artisan beyond:make:query Users UserIndexQuery # requires spatie/laravel-query-builder
php artisan beyond:make:request Users CreateUserRequest
```

## Roadmap

- tbc.

## Authors

- [@regnerisch](https://github.com/regnerisch)
- [@alexgaal](https://github.com/alexgaal)

## License

[ISC](LICENSE.md)
