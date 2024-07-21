# `beyond:make:command`
Creates a new Laravel command.

> [!IMPORTANT]
> You need to add your command with `Artisan::registerCommand(YourCommand::class)` inside `routes/console.php`.

## Signature
`beyond:make:command {name} {--command=command:name} {--force}`

| Parameters | Description              |
|------------|--------------------------|
| name       | The name of your command |

| Flags     | Description             |
|-----------|-------------------------|
| --command | Define the command name |
| --force   | Overwrite existing file |
