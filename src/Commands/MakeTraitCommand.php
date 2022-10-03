<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeTraitCommand extends BaseCommand
{
    protected $signature = 'beyond:make:trait {name?} {--force}';

    protected $description = 'Make a new trait';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new AppNameSchemaResolver($this, $name, support: true))->handle();

            beyond_copy_stub(
                'trait.stub',
                $schema->path('Traits'),
                [
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Trait created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
