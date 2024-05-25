# `beyond:make:collection`
Creates a new Laravel collection for a model.

> [!NOTE]
> You need to add the collection to your model
> ```
> public function newCollection($q): YourCollection
> {
>       return new YourCollection($q);
> }
> ```

## Signature
`beyond:make:collection {name} {--force}`

| Parameters | Description                |
|------------|----------------------------|
| name       | The name of you collection |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
