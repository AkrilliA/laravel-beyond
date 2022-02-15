<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeDataTransferObjectCommand extends Command
{
    protected $signature = 'beyond:make:dto {domain} {className}';

    protected $description = 'Make a new data transfer object';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');

        beyond_copy_stub(
            'data-transfer-object.stub',
            base_path() . "/src/Domain/{$domain}/DataTransferObjects/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
            ]
        );
    }
}
