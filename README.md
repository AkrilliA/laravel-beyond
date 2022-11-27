# Laravel Beyond

*This package is heavily inspired by "Laravel Beyond CRUD" from Spatie. You should check
out [their website](https://spatie.be/products/laravel-beyond-crud).*

This package will help you with `beyond:make` commands to easily create classes inside your "Laravel Beyond CRUD"
inspired application.
We try to implement commands as near as possible on their original `make` counterparts.

## Upgrade Guide
Please read our [Upgrade Guide](UPGRADE.md) in case you are using an older version or `regnerisch/laravel-beyond`.

## Installation

Install laravel-beyond with composer

```bash
composer require --dev akrillia/laravel-beyond
```

After this you can setup it by running

```bash
php artisan beyond:setup
```

This moves everything to the correct place and deletes the `app` folder afterwards. You can also choose to skip this
by adding the `--skip-delete` flag.

Please ensure that you add the following into one of your service providers (e.g. `AppServiceProvider`):

```php
\Illuminate\Database\Eloquent\Factories\Factory::guessFactoryNamesUsing(function (string $modelName) {
    return '\Database\Factories\\' . class_basename($modelName) . 'Factory';
});
```

Do not forget to run `composer dump-autoload` after. So the new namespaces can be found properly.


## Usage

### Commands

#### `beyond:make:action`

This command will create a new action class inside your domain.

```bash
php artisan beyond:make:action Users/CreateUserAction
```

**Options**

| Name       | Description                                        |
|------------|----------------------------------------------------|
| `--force`  | Create the class even if the action already exists |

---

#### `beyond:make:builder`

This command will create a new eloquent builder class inside your domain.

```bash
php artisan beyond:make:builder Users/UserBuilder
```

**Options**

| Name       | Description                                                  |
|------------|--------------------------------------------------------------|
| `--force`  | Create the class even if the eloquent builder already exists |

---

#### `beyond:make:collection`

This command will create a new collection class inside your domain.

```bash
php artisan beyond:make:collection Users/UserCollection
```

**Options**

| Name       | Description                                            |
|------------|--------------------------------------------------------|
| `--model=` | Will create a model related collection                 |
| `--force`  | Create the class even if the collection already exists |

---

#### `beyond:make:command`

This command will create a new command class inside your console application.

```bash
php artisan beyond:make:command SyncUsersCommand
```

**Options**

| Name         | Description                                          |
|--------------|------------------------------------------------------|
| `--command=` | Will use given `command:name` schema for new command |
| `--force`    | Create the class even if the command already exists  |

---

#### `beyond:make:controller`

This command will create a new action class inside your application.

```bash
php artisan beyond:make:controller Admin/Users/UserController
```

**Options**

| Name                | Description                                            |
|---------------------|--------------------------------------------------------|
| `--api`             | Will overwrite an API controller                       |
| `-i`, `--invokable` | Generate a single method, invokable controller class.  |
| `--force`           | Create the class even if the controller already exists |

---

#### `beyond:make:enum`

This command will create a new enum class inside your domain.

```bash
php artisan beyond:make:enum Users/UserStatusEnum
```

**Options**

| Name      | Description                                      |
|-----------|--------------------------------------------------|
| `--force` | Create the class even if the enum already exists |

---

#### `beyond:make:event`

This command will create a new event class inside your application.

```bash
php artisan beyond:make:event Users/UserCreatedEvent
```

**Options**

| Name       | Description                                       |
|------------|---------------------------------------------------|
| `--force`  | Create the class even if the event already exists |

---

#### `beyond:make:dto`

This command will create a new data transfer object class inside your domain.

```bash
php artisan beyond:make:dto Users/UserData
```

**Options**

| Name      | Description                                                      |
|-----------|------------------------------------------------------------------|
| `--force` | Create the class even if the data transfer object already exists |

---

#### `beyond:make:dto-factory Admin/User/UserDataFactory`

This command will create a new data transfer object factory class inside your application.

```bash
php artisan beyond:make:dto-factory Admin/User/UserDataFactory
```

**Options**

| Name      | Description                                             |
|-----------|---------------------------------------------------------|
| `--dto`   | Generate a DTO factory for the given DTO                |
| `--force` | Create the class even if the DTO factory already exists |

---

#### `beyond:make:job`

This command will create a new job class inside your application.

```bash
php artisan beyond:make:job Admin/Users/SyncUsersJob
```

**Options**

| Name      | Description                                     |
|-----------|-------------------------------------------------|
| `--force` | Create the class even if the job already exists |

---

#### `beyond:make:listener`

This command will create a new listener class inside your domain.

```bash
php artisan beyond:make:listener Users/UserCreatedListener
```

**Options**

| Name      | Description                                          |
|-----------|------------------------------------------------------|
| `--force` | Create the class even if the listener already exists |

---

#### `beyond:make:middleware`

This command will create a new middleware class inside your application.

```bash
php artisan beyond:make:middleware Admin/Users/IdentifyUserMiddleware
```

**Options**

| Name        | Description                                            |
|-------------|--------------------------------------------------------|
| `--force`   | Create the class even if the middleware already exists |
| `--support` | Will create a middleware in Support namespace          |

---

#### `beyond:make:model`

This command will create a new model class inside your domain.

```bash
php artisan beyond:make:model Users/User
```

**Options**

| Name                | Description                                       |
|---------------------|---------------------------------------------------|
| `-f`, `--factory`   | Will create a factory for this model              |
| `-m`, `--migration` | Will create a migration for this model            |
| `--force`           | Create the class even if the model already exists |

---

#### `beyond:make:observer`

This command will create a new observer class inside your domain.

```bash
php artisan beyond:make:observer Users/UserObserver
```

**Options**

| Name       | Description                                          |
|------------|------------------------------------------------------|
| `--force`  | Create the class even if the observer already exists |

---

#### `beyond:make:policy`

This command will create a new policy class inside your domain.

```bash
php artisan beyond:make:policy Users/UserPolicy
```

**Options**

| Name       | Description                                        |
|------------|----------------------------------------------------|
| `--model=` | Will create a policy for the given model           |
| `--force`  | Create the class even if the policy already exists |

---

#### `beyond:make:query` __requires spatie/laravel-query-builder__

This command will create a new query class inside your domain.

```bash
php artisan beyond:make:query Admin/Users/UserIndexQuery
```

**Options**

| Name      | Description                                               |
|-----------|-----------------------------------------------------------|
| `--force` | Create the class even if the query builder already exists |

---

#### `beyond:make:request`

This command will create a new request class inside your application.

```bash
php artisan beyond:make:request Admin/Users/CreateUserRequest
```

**Options**

| Name      | Description                                         |
|-----------|-----------------------------------------------------|
| `--force` | Create the class even if the request already exists |

---

#### `beyond:make:resource`

This command will create a new resource class inside your application.

```bash
php artisan beyond:make:resource Admin/Users/UserResource
```

**Options**

| Name           | Description                                          |
|----------------|------------------------------------------------------|
| `--collection` | Will create a collection                             |
| `--force`      | Create the class even if the resource already exists |

---

#### `beyond:make:route`

This command will create a new route file inside your routes folder.

```bash
php artisan beyond:make:route Users
```

**Options**

| Name      | Description                                       |
|-----------|---------------------------------------------------|
| `--force` | Create the class even if the route already exists |

---

#### `beyond:make:rule`

This command will create a new rule class inside your application.

```bash
php artisan beyond:make:rule Admin/Users/IsAdminRule
```

**Options**

| Name        | Description                                      |
|-------------|--------------------------------------------------|
| `--force`   | Create the class even if the rule already exists |
| `--support` | Will create a middleware in Support namespace    |

---

#### `beyond:make:trait`

This command will create a new trait class inside your application.

```bash
php artisan beyond:make:trait HasActivationCodeTrait
```

**Options**

| Name        | Description                                       |
|-------------|---------------------------------------------------|
| `--force`   | Create the trait even if the trait already exists |

---

#### `beyond:make:provider`

This command will create a new service provider class.

```bash
php artisan beyond:make:provider UserServiceProvider
```

**Options**

| Name      | Description                                                  |
|-----------|--------------------------------------------------------------|
| `--force` | Create the class even if the service provider already exists |

---

#### `beyond:setup`

This command will setup a default Laravel installation into a DDD structure.

```bash
php artisan beyond:setup
```

**Options**

| Name            | Description                                       |
|-----------------|---------------------------------------------------|
| `--force`       | Create the class even if the class already exists |
| `--skip-delete` | Will skip the deletion of app directory           |

---

## Contributors

- [@regnerisch](https://github.com/regnerisch)
- [@alexgaal](https://github.com/alexgaal)
- [@nilsvennemann](https://github.com/nilsvennemann)
- [@Enaah](https://github.com/Enaah)
- [@thewebartisan7](https://github.com/thewebartisan7)
- [@Wulfheart](https://github.com/Wulfheart)
- [@dimzeta](https://github.com/dimzeta)
- [@krishnahimself](https://github.com/krishnahimself)

## License

[ISC](LICENSE.md)
