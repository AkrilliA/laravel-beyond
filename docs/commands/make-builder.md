# `beyond:make:builder`
Creates a new Laravel Eloquent builder for a model.

> [!NOTE]
> You need to add the builder to your model
> ```
> public function newEloquentBuilder($query): Builder
> {
>     return new UserBuilder($query);
> }
> ```

> [!NOTE]
> For proper IDE support add the following docblock to you model
> ```
> /**
>  * @method static UserBuilder query()
>  */
> class User extends Model
> ```

## Signature
`beyond:make:builder {name} {--force}`

| Parameters | Description             |
|------------|-------------------------|
| name       | The name of you builder |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
