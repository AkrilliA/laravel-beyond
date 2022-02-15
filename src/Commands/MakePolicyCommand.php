<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakePolicyCommand extends Command
{
    protected $signature = 'beyond:make:policy {domain} {className} {--model=}';

    protected $description = 'Make a new policy';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');
        $model = $this->argument('model');

        beyond_copy_stub(
            'policy.stub',
            base_path() . "/src/Domain/{$domain}/Policies/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
                '{{ model }}' => $model,
            ]
        );
    }
}
