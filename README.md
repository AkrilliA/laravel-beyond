# Laravel Beyond

This package should help you with creating and managing a Laravel DDD Application. 
This package is heavily inspired by "Laravel beyond CRUD" from Spatie.

## Installation

Install laravel-beyond with composer

```bash
composer require --dev regnerisch/laravel-beyond
```

## Usage

### Commands
|Command|Namespace|Required Packages|
|---|---|---|
|`php artisan beyond:make:action Users/CreateUserAction`|Domain/Users/Actions/CreateUserAction||
|`php artisan beyond:make:collection Users/UserCollection`|Domain/Users/Collections/UserCollection||
|`php artisan beyond:make:command SyncUsersCommand`|App/Console/Commands/SyncUsersCommand||
|`php artisan beyond:make:controller Admin/Users/UserController`|App/Admin/Users/Controllers/UserController||
|`php artisan beyond:make:dto Users/UserData`|Domain/Users/DataTransferObjects/UserData|spatie/data-transfer-object|
|`php artisan beyond:make:job Admin/Users/SyncUsersJob`|App/Admin/Users/Jobs/SyncUsersJob||
|`php artisan beyond:make:model Users/User`|Domain/Users/Models/User||
|`php artisan beyond:make:policy Users/UserPolicy`|Domain/Users/Policies/UserPolicy||
|`php artisan beyond:make:query-builder Users/UserQueryBuilder`|Domain/Users/QueryBuilders/UserQueryBuilder||
|`php artisan beyond:make:query Admin/Users/UserIndexQuery`|App/Admin/Users/Queries/UserIndexQuery|spatie/laravel-query-builder|
|`php artisan beyond:make:request Admin/Users/CreateUserRequest`|App/Admin/Users/Requests/CreateUserRequest||
|`php artisan beyond:make:resource Admin/Users/UserResource`|App/Admin/Users/Resources/UserResource||
|`php artisan beyond:make:route Users`|Creates a new file at routes/users.php||
|`php artisan beyond:setup`|Sets up a domain-driven application||

#### Set up a domain-driven application
After installing `laravel-beyond` you can easily set up a domain-driven application. 
You just need to run `php artisan beyond:setup` on a fresh Laravel application or 
`php artisan beyond:setup --skip-delete` to keep you `app` directory with your existing
code. 

Do not forget to run `composer dump-autoload` after. So the new namespaces can be found properly.

## Authors

- [@regnerisch](https://github.com/regnerisch)
- [@alexgaal](https://github.com/alexgaal)

## License

[ISC](LICENSE.md)
