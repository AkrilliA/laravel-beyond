<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeControllerCommand extends Command
{
    protected $signature = 'beyond:make:controller {application} {className} {--api}';

    protected $description = 'Make a new controller';

    public function handle()
    {
        $application = $this->argument('application');
        $className = $this->argument('className');
        $api = $this->option('api');

        $stub = $api ? 'controller.api.stub' : 'controller.stub';

        beyond_copy_stub(
            $stub,
            app_path() . "/../src/App/{$application}/Controllers/{$className}.php",
            [
                '{{ application }}' => $application,
                '{{ className }}' => $className,
            ]
        );
    }
}
