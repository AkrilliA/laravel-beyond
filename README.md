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
command on a freshly installed Laravel app, as it will delete files and rename things. After the setup has finished
you need to run `composer dump-autoload`.

You can 'make' Controllers, Commands, Models as you know it from Laravels' `php artisan make:...` with the `beyond:make:...` command.
For application commands e.g. `php artisan beyond:make:controller` you need to enter the following schema: `{App}/{Module}/{Class}`:
```bash
php artisan beyond:make:controller Admin/Users/UserController
```

For domain commands e.g. `php artisan beyond:make:action` you need to enter the following schema: `{Domain}/{Class}`:
```bash
php artisan beyond:make:action Users/CreateUserAction
```

Making commands (with `php artisan beyond:make:command`) will automatically force them to the `Command` application, so you 
only need to enter the command name: `php artisan beyond:make:command SyncUsersCommand`.

### Commands
```bash
php artisan beyond:make:action Users/CreateUserAction
php artisan beyond:make:collection Users/UserCollection
php artisan beyond:make:command UpdateUsersCommand
php artisan beyond:make:controller Admin/Users/UserController
php artisan beyond:make:dto Users/UserData # required spatie/data-transfer-object
php artisan beyond:make:job Admin/Users/SyncUsersJob
php artisan beyond:make:model Users/User
php artisan beyond:make:policy Users/UserPolicy
php artisan beyond:make:query-builder Users/UserQueryBuilder
php artisan beyond:make:query Admin/Users/UserIndexQuery # requires spatie/laravel-query-builder
php artisan beyond:make:request Admin/Users/CreateUserRequest
php artisan beyond:make:resource Admin/Users/UserResource
php artisan beyond:make:route Users
php artisan beyond:setup
```

## Roadmap

- tbc.

## Authors

- [@regnerisch](https://github.com/regnerisch)
- [@alexgaal](https://github.com/alexgaal)

## License

[ISC](LICENSE.md)
