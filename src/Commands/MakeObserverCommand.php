<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeObserverCommand extends BaseCommand
{
    protected $signature = 'beyond:make:observer {name?} {--force}';

    protected $description = 'Make a new observer';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'observer.stub',
                $schema->path('Observers'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Observer created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
