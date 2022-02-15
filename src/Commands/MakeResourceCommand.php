<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeResourceCommand extends Command
{
    protected $signature = 'beyond:make:resource {application} {className} {--collection}';

    protected $description = 'Make a new resource';

    public function handle()
    {
        $application = $this->argument('application');
        $className = $this->argument('className');
        $collection = $this->option('collection');

        $stub = (str_contains($className, 'Collection') || $collection) ? 'collection.stub' : 'resource.stub';

        beyond_copy_stub(
            $stub,
            base_path() . "/src/App/{$application}/Resources/{$className}.php",
            [
                '{{ application }}' => $application,
                '{{ className }}' => $className,
            ]
        );
    }
}
