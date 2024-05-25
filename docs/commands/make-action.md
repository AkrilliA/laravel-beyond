# `beyond:make:action`
Creates a new action. An action does run one specific task, e.g. storing or updating a model.
If you need to do additional tasks like logging you should wrap those inside their own action
or (maybe better) consider using a [process](make-process.md).

## Signature
`beyond:make:action {name} {--force}`

| Parameters | Description            |
|------------|------------------------|
| name       | The name of you action |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |