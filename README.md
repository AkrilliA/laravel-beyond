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
```bash
# Creates an action at Domain/Users/Actions/CreateUserAction
php artisan beyond:make:action Users/CreateUserAction

# Creates a collection at Domain/Users/Collections/UserCollection
php artisan beyond:make:collection Users/UserCollection

# Creates a command at App/Console/Commands/SyncUserCommand
php artisan beyond:make:command SyncUserCommand

# Creates a controller at App/Admin/Users/Controllers/UserController
php artisan beyond:make:controller Admin/Users/UserController

# Creates an enum at Domain/Users/Enums/UserStatusEnum
php artisan beyond:make:enum Users/UserStatusEnum

# Creates an event at Domain/Users/Events/UserCreatedEvent
php artisan beyond:make:event Users/UserCreatedEvent

# Creates a data transfer object at Domain/Users/DataTransferObjects/UserData (requires spatie/data-transfer-object)
php artisan beyond:make:dto Users/UserData

# Creates a job at App/Admin/Users/Jobs/SyncUsersJob
php artisan beyond:make:job Admin/Users/SyncUsersJob

# Creates a listener at Domain/Users/Listeners/UserCreatedListener
php artisan beyond:make:listener Users/Listeners/UserCreatedListener

# Creates a model at Domain/Users/Models/User
php artisan beyond:make:model Users/User

# Creates a policy at Domain/Users/Policies/UserPolicy
php artisan beyond:make:policy Users/UserPolicy

# Creates an eloquent query builder at Domain/Users/QueryBuilders/UserQueryBuilder
php artisan beyond:make:query-builder Users/UserQueryBuilder

# Creates a query at App/Admin/Users/Queries/UserIndexQuery (requires spatie/laravel-query-builder)
php artisan beyond:make:query Admin/Users/UserIndexQuery

# Creates a request at App/Admin/Users/Requests/CreateUserRequest
php artisan beyond:make:request Admin/Users/CreateUserRequest

# Creates a resource at App/Admin/Users/Resources/UserResource
php artisan beyond:make:resource Admin/Users/UserResource

# Creates a route file at routes/users.php
php artisan beyond:make:route Users

# Creates a rule at App/Admin/Users/Rules/IsAdminRule
php artisan beyond:make:rule Admin/Users/IsAdminRule

# Creates a service provider at App/Providers/UserServiceProvider
php artisan beyond:make:provider UserServiceProvider

# Sets up a domain-driven application
php artisan beyond:setup
```

### Set up a domain-driven application
After installing `laravel-beyond` you can easily set up a domain-driven application. 
You just need to run `php artisan beyond:setup` on a fresh Laravel application or 
`php artisan beyond:setup --skip-delete` to keep you `app` directory with your existing
code. 

Do not forget to run `composer dump-autoload` after. So the new namespaces can be found properly.

## Contributors

- [@regnerisch](https://github.com/regnerisch)
- [@alexgaal](https://github.com/alexgaal)
- [@nilsvennemann](https://github.com/nilsvennemann)
- [@Enaah](https://github.com/Enaah)

## License

[ISC](LICENSE.md)
