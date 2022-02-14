<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeRequestCommand extends Command
{
    protected $signature = 'beyond:make:request {application} {className}';

    protected $description = 'Make a new request';

    public function handle()
    {
        $application = $this->argument('application');
        $className = $this->argument('className');

        beyond_copy_stub(
            'request.stub',
            base_path() . "/src/App/{$application}/Requests/{$className}.php",
            [
                '{{ application }}' => $application,
                '{{ className }}' => $className,
            ]
        );
    }
}
