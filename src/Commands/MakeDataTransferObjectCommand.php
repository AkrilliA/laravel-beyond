<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Helpers\Stub;

class MakeDataTransferObjectCommand extends Command
{
    protected $signature = 'beyond:make:action {domain} {className}';

    protected $description = 'Make a new data transfer object';

    public function handle()
    {
        $domain = $this->argument('domain');
        $className = $this->argument('className');

        Stub::makeFromTemplate(
            'data-transfer-object.stub',
            app_path() . "/../src/Domain/{$domain}/DataTransferObjects/{$className}.php",
            [
                '{{ domain }}' => $domain,
                '{{ className }}' => $className,
            ]
        );
    }
}
