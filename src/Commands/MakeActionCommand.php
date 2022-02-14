<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeActionCommand extends Command
{
    protected $signature = 'beyond:make:action {domain} {className}';

    protected $description = 'Make a new action';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');

        Stub::makeFromTemplate(
            'action.stub',
            app_path() . "/../src/Domain/{$domain}/Actions/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
            ]
        );
    }
}
