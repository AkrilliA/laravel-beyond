# `beyond:make:policy`
Creates a new policy.

> [!IMPORTANT]
> Policies are created per application. This is not supported by Laravel by default 
> and requires a configuration of the `Gate::guessPolicyNamesUsing` method. 
> If you do not want to make these changes, create your policies 
> manually under `src/Domain/{Domain}/Policies`.

> [!NOTE]
> To use application policies in Laravel, you need to do two things: 
> Each application **must** have its own unique route prefix. Additionally, you need to add 
> the following code to the `boot` method in your `AppServiceProvider`:
> ```php
> Gate::guessPolicyNamesUsing(function (string $modelName): string {
>     $defaultPolicy = Str::replace('Models', 'Policies', $modelName).'Policy';
>     $request = $this->app['request'];
>
>     $app = match (true) {
>         $request->is('your-app-prefix/*')  => 'YourApp', // YourApp is the app name inside "src/Application"
>         $request->is('your-app2-prefix/*') => 'YourAppTwo',
>         default                            => null,
>     };
>
>     if ($app) {
>         $appPolicy = 'Application\\'.$app.'\\Policies\\'.class_basename($modelName).'Policy';
>         if (class_exists($appPolicy)) {
>             return $appPolicy;
>         }
>     }
>
>     return $defaultPolicy;
> });
> ```
> This name guesser guesses the right application policy and falls back to the default Laravel
> policy if no application policy is found.


## Signature 
`beyond:make:policy {name} {--force}`

| Parameters | Description             |
|------------|-------------------------|
| name       | The name of your policy |

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
