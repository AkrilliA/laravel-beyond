<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeServiceProviderCommand extends Command
{
    protected $signature = 'beyond:make:provider {className} {--overwrite}';

    protected $description = 'Create a new service provider';

    public function handle(): void
    {
        try {
            $className = $this->argument('className');
            $overwrite = $this->option('overwrite');

            beyond_copy_stub(
                'service.provider.stub',
                base_path() . "/src/App/Providers/{$className}.php",
                [
                    '{{ className }}' => $className,
                ],
                $overwrite
            );

            $this->info('Service provider created.');
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
