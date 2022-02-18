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
            app_path() . "/../src/App/{$application}/routes/{$applicationNameLowerCase}.php",
            [
                '{{ application }}' => $applicationNameLowerCase,
            ]
        );


        $this->info(
            "Please add following route entry to your RouteServiceProvider" . PHP_EOL . PHP_EOL .

                "\tRoute::prefix('api')" . PHP_EOL .
                    "\t\t->middleware('api')" . PHP_EOL .
                    "\t\t->namespace($this->namespace)" . PHP_EOL .
                    "\t\t->group(base_path('routes/api.php'));"
        );
    }
}
