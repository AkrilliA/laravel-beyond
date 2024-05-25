# `beyond:make:collection`
Creates a new Laravel collection for a model.

> [!NOTE]
> You need to add the collection to your model
> ```php
> public function newCollection(array $models = []): Collection
> {
>     return new UserCollection($models);
> }
> ```

## Signature
`beyond:make:collection {name} {--force}`

| Parameters | Description                 |
|------------|-----------------------------|
| name       | The name of your collection |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
