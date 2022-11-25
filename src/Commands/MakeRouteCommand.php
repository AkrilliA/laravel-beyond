<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeRouteCommand extends BaseCommand
{
    protected $signature = 'beyond:make:route {routeName?} {--force}';

    protected $description = 'Make a new file for routes';

    public function handle()
    {
        try {
            $routeName = $this->argument('routeName');

            while (! $routeName) {
                $routeName = $this->ask('Please enter the route name');
            }

            $routeNameLowerCase = mb_strtolower($routeName);
            $force = $this->option('force');

            beyond_copy_stub(
                'routes.stub',
                base_path()."/routes/{$routeNameLowerCase}.php",
                [
                    '{{ application }}' => $routeNameLowerCase,
                ],
                $force
            );

            $this->info(
                'Please add following route entry to your RouteServiceProvider. Please take care of using the correct middleware. This could differ from the default middleware.'.PHP_EOL.PHP_EOL.

                "Route::prefix('{$routeNameLowerCase}')".PHP_EOL.
                "\t->middleware('api')".PHP_EOL.
                "\t".'->namespace($this->namespace)'.PHP_EOL.
                "\t->group(base_path('routes/{$routeNameLowerCase}.php'));"
            );

            $this->components->info('Route created.');
        } catch (\Exception $e) {
            $this->components->error($e->getMessage());
        }
    }
}
