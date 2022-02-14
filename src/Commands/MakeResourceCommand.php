<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeResourceCommand extends Command
{
    protected $signature = 'beyond:make:resource {application} {className} {--collection}';

    protected $description = 'Make a new resource';

    public function handle()
    {
        $application = $this->argument('application');
        $className = $this->argument('className');
        $collection = $this->argument('collection');

        $stub = $collection ? 'collection.stub' : 'resource.stub';

        Stub::makeFromTemplate(
            $stub,
            app_path() . "/../src/App/{$application}/Resources/{$className}.php",
            [
                '{{ application }}' => $application,
                '{{ className }}' => $className,
            ]
        );
    }
}
