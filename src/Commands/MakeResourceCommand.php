<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeResourceCommand extends Command
{
    protected $signature = 'beyond:make:resource {domain} {className} {--collection}';

    protected $description = 'Make a new resource';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');
        $collection = $this->argument('collection');

        $stub = $collection ? 'collection.stub' : 'resource.stub';

        Stub::makeFromTemplate(
            $stub,
            app_path() . "/../src/Domain/{$domain}/Http/Resources/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
            ]
        );
    }
}
