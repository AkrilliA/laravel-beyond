<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeControllerCommand extends Command
{
    protected $signature = 'beyond:make:controller {application} {className}';

    protected $description = 'Make a new controller';

    public function handle()
    {
        $application = $this->argument('application');
        $className = $this->argument('className');

        Stub::makeFromTemplate(
            'controller.stub',
            app_path() . "/../src/App/{$application}/Controllers/{$className}.php",
            [
                '{{ application }}' => $application,
                '{{ className }}' => $className,
            ]
        );
    }
}
