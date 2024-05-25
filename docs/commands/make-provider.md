# `beyond:make:provider`
Creates a new service provider. 

> [!NOTE]
> Within the register method, you should **only bind things into the service container**.
> Because of this, service containers are **not** created under `Application/{App}/Providers` 
> We want to avoid the feeling of registering things per application. You always register things 
> for your entire Laravel project.

## Signature
`beyond:make:provider {name} {--force}`

| Parameters | Description               |
|------------|---------------------------|
| name       | The name of your provider |

| Flags    | Description             |
|----------|-------------------------|
| --force  | Overwrite existing file |
