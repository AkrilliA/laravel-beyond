<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeServiceProviderCommand extends BaseCommand
{
    protected $signature = 'beyond:make:provider {name} {--force}';

    protected $description = 'Create a new service provider';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            beyond_copy_stub(
                'service.provider.stub',
                base_path()."/src/App/Providers/{$name}.php",
                [
                    '{{ className }}' => $name,
                ],
                $force
            );

            $this->components->info('Service provider created.');
        } catch (\Exception $e) {
            $this->components->error($e->getMessage());
        }
    }
}
