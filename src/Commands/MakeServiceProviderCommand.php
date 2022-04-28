<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeServiceProviderCommand extends Command
{
    protected $signature = 'beyond:make:provider {className}';

    protected $description = 'Create a new service provider';

    public function handle()
    {
        try {
            $className = $this->argument('className');

            beyond_copy_stub(
                'service.provider.stub',
                base_path() . "/src/App/Providers/{$className}.php",
                [
                    '{{ className }}' => $className,
                ]
            );

            $this->info('Service provider created.');
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
