<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeModelCommand extends Command
{
    protected $signature = 'beyond:make:model {domain} {className}';

    protected $description = 'Make a new model';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');

        beyond_copy_stub(
            'model.stub',
            base_path() . "/src/Domain/{$domain}/Models/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
            ]
        );
    }
}
