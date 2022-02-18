<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeRouteCommand extends Command
{
    protected $signature = 'beyond:make:route {application}';

    protected $description = 'Make a new file for routes';

    public function handle()
    {
        $application = $this->argument('application');
        $applicationNameLowerCase = strtolower($application);

        beyond_copy_stub(
            'routes.stub',
            app_path() . "/../routes/{$applicationNameLowerCase}.php",
            [
                '{{ application }}' => $applicationNameLowerCase,
            ]
        );


        $this->info(
            "Please add following route entry to your RouteServiceProvider. Please take care of using the correct middleware. This could differ from the default middleware." . PHP_EOL . PHP_EOL .

            "\tRoute::prefix('" . $applicationNameLowerCase . "')" . PHP_EOL .
                "\t\t->middleware('api')" . PHP_EOL .
                "\t\t->namespace($this->namespace)" . PHP_EOL .
                "\t\t->group(base_path('routes/$applicationNameLowerCase.php'));"
        );
    }
}
