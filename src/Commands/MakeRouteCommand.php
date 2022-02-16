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

        beyond_copy_stub(
            'routes.stub',
            app_path() . "/../src/App/{$application}/routes/web.php",
            [
                '{{ application }}' => $application,
            ]
        );
    }
}
