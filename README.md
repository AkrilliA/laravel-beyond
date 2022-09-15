# Laravel Beyond

*This package is heavily inspired by "Laravel Beyond CRUD" from Spatie. You should check
out [their website](https://spatie.be/products/laravel-beyond-crud).*

This package will help you with `beyond:make` commands to easily create classes inside your "Laravel Beyond CRUD"
inspired application.
We try to implement commands as near as possible on their original `make` counterparts.

## Installation

Install laravel-beyond with composer

```bash
composer require --dev regnerisch/laravel-beyond
```

## Usage

### Commands

#### `beyond:make:action`

This command will create a new action class inside your domain.

```bash
php artisan beyond:make:action Users/CreateUserAction
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:builder`

This command will create a new eloquent builder class inside your domain.

```bash
php artisan beyond:make:builder Users/UserBuilder
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:collection`

This command will create a new collection class inside your domain.

```bash
php artisan beyond:make:collection Users/UserCollection
```

**Options**

| Name          | Description                            |
|---------------|----------------------------------------|
| `--model=`    | Will create a model related collection |
| `--overwrite` | Will overwrite the file if it exists   |

---

#### `beyond:make:command`

This command will create a new command class inside your console application.

```bash
php artisan beyond:make:command SyncUsersCommand
```

**Options**

| Name          | Description                                          |
|---------------|------------------------------------------------------|
| `--command=`  | Will use given `command:name` schema for new command |
| `--overwrite` | Will overwrite the file if it exists                 |

---

#### `beyond:make:controller`

This command will create a new action class inside your application.

```bash
php artisan beyond:make:controller Admin/Users/UserController
```

**Options**

| Name          | Description                          |
|---------------|--------------------------------------|
| `--api`       | Will overwrite an API controller     |
| `--overwrite` | Will overwrite the file if it exists |

---

#### `beyond:make:enum`

This command will create a new enum class inside your domain.

```bash
php artisan beyond:make:enum Users/UserStatusEnum
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:event`

This command will create a new event class inside your application.

```bash
php artisan beyond:make:event Users/UserCreatedEvent
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:dto`

This command will create a new data transfer object class inside your domain.

```bash
php artisan beyond:make:dto Users/UserData
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:job`

This command will create a new job class inside your application.

```bash
php artisan beyond:make:job Admin/Users/SyncUsersJob
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:listener`

This command will create a new listener class inside your domain.

```bash
php artisan beyond:make:listener Users/UserCreatedListener
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:middleware`

This command will create a new middleware class inside your application.

```bash
php artisan beyond:make:middleware Admin/Users/IdentifyUserMiddleware
```

**Options**

| Name          | Description                                   |
|---------------|-----------------------------------------------|
| `--overwrite` | Will overwrite the file if it exists          |
| `--support`   | Will create a middleware in Support namespace |

---

#### `beyond:make:model`

This command will create a new model class inside your domain.

```bash
php artisan beyond:make:model Users/User
```

**Options**

| Name                | Description                            |
|---------------------|----------------------------------------|
| `-f`, `--factory`   | Will create a factory for this model   |
| `-m`, `--migration` | Will create a migration for this model |
| `--overwrite`       | Will overwrite the file if it exists   |

---

#### `beyond:make:policy`

This command will create a new policy class inside your domain.

```bash
php artisan beyond:make:policy Users/UserPolicy
```

**Options**

| Name          | Description                              |
|---------------|------------------------------------------|
| `--model=`    | Will create a policy for the given model |
| `--overwrite` | Will overwrite the file if it exists     |

---

#### `beyond:make:query` __requires spatie/laravel-query-builder__

This command will create a new query class inside your domain.

```bash
php artisan beyond:make:query Admin/Users/UserIndexQuery
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:request`

This command will create a new request class inside your application.

```bash
php artisan beyond:make:request Admin/Users/CreateUserRequest
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:resource`

This command will create a new resource class inside your application.

```bash
php artisan beyond:make:resource Admin/Users/UserResource
```

**Options**

| Name           | Description                          |
|----------------|--------------------------------------|
| `--collection` | Will create a collection             |
| `--overwrite`  | Will overwrite the file if it exists |

---

#### `beyond:make:route`

This command will create a new route file inside your routes folder.

```bash
php artisan beyond:make:route Users
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:make:rule`

This command will create a new rule class inside your application.

```bash
php artisan beyond:make:rule Admin/Users/IsAdminRule
```

**Options**

| Name          | Description                                   |
|---------------|-----------------------------------------------|
| `--overwrite` | Will overwrite the file if it exists          |
| `--support`   | Will create a middleware in Support namespace |

---

#### `beyond:make:provider`

This command will create a new service provider class.

```bash
php artisan beyond:make:provider UserServiceProvider
```

**Options**

| Name          | Description                           |
|---------------|---------------------------------------|
| `--overwrite` | Will overwrite the file if it exists  |

---

#### `beyond:setup`

This command will setup a default Laravel installation into a DDD structure.

```bash
php artisan beyond:setup
```

**Options**

| Name            | Description                             |
|-----------------|-----------------------------------------|
| `--overwrite`   | Will overwrite the file if it exists    |
| `--skip-delete` | Will skip the deletion of app directory |

---

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
- [@thewebartisan7](https://github.com/thewebartisan7)
- [@Wulfheart](https://github.com/Wulfheart)

## License

[ISC](LICENSE.md)
