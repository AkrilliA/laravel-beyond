<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakePolicyCommand extends Command
{
    protected $signature = 'beyond:make:policy {domain} {className} {--model=}';

    protected $description = 'Make a new policy';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');
        $model = $this->argument('model');

        Stub::makeFromTemplate(
            'model.stub',
            app_path() . "/../src/Domain/{$domain}/Policies/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
                '{{ model }}' => $model,
            ]
        );
    }
}
