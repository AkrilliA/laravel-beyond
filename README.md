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

Install laravel-beyond with composer

```bash
composer require --dev akrillia/laravel-beyond
```

Register the namespaces inside your `composer.json`.
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

## Structure
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

## Usage


## ToDo
### Commands
- `beyond:make:filter`
- `beyond:make:exception`
- `beyond:make:state`
- `beyond:make:value-object`
- `beyond:make:factory` (?)
- `beyond:make:migration` (?)
- `beyond:make:seeder` (?)
- `beyond:make:test` (?)
### Other
- Update command documentation

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
