<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeListenerCommand extends BaseCommand
{
    protected $signature = 'beyond:make:listener {name?} {--force}';

    protected $description = 'Make a new listener';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'listener.stub',
                $schema->path('Listeners'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Listener created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
