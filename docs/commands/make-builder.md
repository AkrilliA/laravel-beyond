# `beyond:make:builder`
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

## Signature
`beyond:make:builder {name} {--force}`

| Parameters | Description             |
|------------|-------------------------|
| name       | The name of you builder |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
