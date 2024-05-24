# Laravel Beyond

*This package is inspired by "[Laravel Beyond CRUD](https://spatie.be/products/laravel-beyond-crud)" from Spatie
and "[Modularising the Monolith](https://www.youtube.com/watch?v=0Rq-yHAwYjQ&t=4129s)" from Ryuta Hamasaki.*

This package will help you with `beyond:make` commands to easily create classes inside your "Laravel Beyond CRUD"
inspired application.

In version 7 we changed the way how Laravel Beyond works. We now do no longer change Laravels default
directory structure, instead we place the DDD structure inside a separate `src` directory. This ensures
compatibility with any other (Laravel related) package. 

## Upgrade Guide
Please read our [Upgrade Guide](UPGRADE.md) in case you are using an older version or `regnerisch/laravel-beyond`.

## Installation

Install laravel-beyond with composer:
```bash
composer require --dev akrillia/laravel-beyond
```

Register the namespaces inside your `composer.json`:
```json
{
  // ...
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Database\\Factories\\": "database/factories/",
      "Database\\Seeders\\": "database/seeders/",
      "Application\\": "src/Application",
      "Domain\\": "src/Domain"
    }
  },
  // ...
}
```
Run `composer dump-autoload` and everything is set up for using Laravel Beyond commands. 

## Commands
### Overview
#### Application
- `beyond:make:command`
- `beyond:make:controller`
- `beyond:make:policy`
- `beyond:make:process`
- `beyond:make:query`
- `beyond:make:request`
- `beyond:make:resource`
- `beyond:make:rule`

#### Domain
- `beyond:make:action`
- `beyond:make:builder`
- `beyond:make:collection`
- `beyond:make:data`
- `beyond:make:enum`
- `beyond:make:event`
- `beyond:make:job`
- `beyond:make:listener`
- `beyond:make:model`
- `beyond:make:observer`

### Detail
#### `beyond:make:action`
Creates a new action. An action does run one specific task, e.g. storing or updating a model.
If you need to do additional tasks like logging you should wrap those inside their own action 
or (maybe better) consider using a process.

##### Signature
`beyond:make:action {name} {--force}`

| Parameters | Description            |
|------------|------------------------|
| name       | The name of you action |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |


#### `beyond:make:builder`
Creates a new Laravel Eloquent builder for a model.

> [!NOTE]
> You need to add the builder to your model
> ```
> public function newEloquentBuilder($q): YourBuilder
> {
>       return new YourBuilder($q);
> }
> ```

> [!NOTE]
> For proper IDE support add the following docblock to you model
> ```
> /**
>  * @method static YourBuilder query()
>  */
> class User extends Model
> ```

##### Signature
`beyond:make:builder {name} {--force}`

| Parameters | Description             |
|------------|-------------------------|
| name       | The name of you builder |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |



## Directory structure
```
|- src
|  |- Application
|  |  |- Admin
|  |  |  |- Commands
|  |  |  |- Controllers
|  |  |  |- Jobs
|  |  |  |- Policies
|  |  |  |- Processes
|  |  |  |- Queries
|  |  |  |- Requests
|  |  |  |- Resources
|  |  |  |- Rules
|  |- Domain
|  |  |- User
|  |  |  |- Actions
|  |  |  |- Builder
|  |  |  |- Collections
|  |  |  |- DataObjects
|  |  |  |- Enums
|  |  |  |- Events
|  |  |  |- Listeners
|  |  |  |- Models
|  |  |  |- Observers
```

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
