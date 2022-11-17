<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeEventCommand extends BaseCommand
{
    protected $signature = 'beyond:make:event {name?} {--force}';

    protected $description = 'Make a new event';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'event.stub',
                $schema->path('Events'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Event created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
