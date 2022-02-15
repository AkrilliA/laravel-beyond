<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeQueryCommand extends Command
{
    protected $signature = 'beyond:make:query {application} {className}';

    protected $description = 'Make a new query';

    public function handle()
    {
        $application = $this->argument('application');
        $className = $this->argument('className');

        beyond_copy_stub(
            'query.stub',
            base_path() . "/src/App/{$application}/Queries/{$className}.php",
            [
                '{{ application }}' => $application,
                '{{ className }}' => $className,
            ]
        );
    }
}
