<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeModelCommand extends Command
{
    protected $signature = 'beyond:make:model {domain} {className}';

    protected $description = 'Make a new model';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');

        Stub::makeFromTemplate(
            'model.stub',
            app_path() . "/../src/Domain/{$domain}/Models/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
            ]
        );
    }
}
