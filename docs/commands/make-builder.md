# `beyond:make:builder`
Creates a new Laravel Eloquent builder for a model.

> [!NOTE]
> You need to add the builder to your model
> ```php
> public function newEloquentBuilder($query): Builder
> {
>     return new UserBuilder($query);
> }
> ```

> [!NOTE]
> For proper IDE support add the following docblock to you model
> ```php
> /**
>  * @method static UserBuilder query()
>  */
> class User extends Model
> ```

## Signature
`beyond:make:builder {name} {--force}`

| Parameters | Description              |
|------------|--------------------------|
| name       | The name of your builder |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
