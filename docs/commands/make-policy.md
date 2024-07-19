# `beyond:make:policy`
Creates a new policy.

> [!NOTE]
> If you used the `beyond:publish:gate` command, all new policies will be created inside you applications. You can have
> the same policy for every application. Use `Gate::app('{AppName}')` followed by your authorization method 
> (e.g. `Gate::app('Admin')->authorize('view', $user)`) to tell Laravel which application to search for the policy. 
> If no policy is found, it will fall back to Laravels default policy handling.

## Signature 
`beyond:make:policy {name} {--force}`

| Parameters | Description             |
|------------|-------------------------|
| name       | The name of your policy |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
