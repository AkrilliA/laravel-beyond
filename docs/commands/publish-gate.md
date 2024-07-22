# `beyond:publish:gate`
Publishes a custom Gate which allows you to use/create policies on applications. This can be useful if you have multiple 
applications which require specific authorization per application. 

> [!NOTE]
> You need to add the `Support\\Beyond\\Gate` to your `AppServiceProvider`s `register` function:
> ```php
> use Illuminate\Contracts\Auth\Access\Gate as GateContract;
> use Support\Beyond\Gate;
> 
> $this->app->singleton(GateContract::class, function ($app) {
>     return new Gate($app, fn () => call_user_func($app['auth']->userResolver()));
> });
> ```

## Signature 
`beyond:publish:gate {--force}`

| Flags   | Description             |
|---------|-------------------------|
| --force | Overwrite existing file |
