<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeRouteCommand extends Command
{
    protected $signature = 'beyond:make:route {routeName?} {--overwrite}';

    protected $description = 'Make a new file for routes';

    public function handle()
    {
        try {
            $routeName = $this->argument('routeName');

            while (!$routeName) {
                $routeName = $this->ask('Please enter the route name');
            }

            $routeNameLowerCase = mb_strtolower($routeName);
            $overwrite = $this->option('overwrite');

            beyond_copy_stub(
                'routes.stub',
                base_path() . "/routes/{$routeNameLowerCase}.php",
                [
                    '{{ application }}' => $routeNameLowerCase,
                ],
                $overwrite
            );

            $this->info(
                'Please add following route entry to your RouteServiceProvider. Please take care of using the correct middleware. This could differ from the default middleware.' . PHP_EOL . PHP_EOL .

                "Route::prefix('{$routeNameLowerCase}')" . PHP_EOL .
                "\t->middleware('api')" . PHP_EOL .
                "\t" . '->namespace($this->namespace)' . PHP_EOL .
                "\t->group(base_path('routes/{$routeNameLowerCase}.php'));"
            );

            $this->info('Route created.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
