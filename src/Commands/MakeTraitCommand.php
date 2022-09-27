<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeTraitCommand extends BaseCommand
{
    protected $signature = 'beyond:make:trait {name?} {--support} {--force}';

    protected $description = 'Make a new trait';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $support = $this->option('support');
            $force = $this->option('force');

            $stub = $support ? 'trait.support.stub' : 'trait.stub';
            $schema = $support ?
                (new AppNameSchemaResolver($this, $name, support: $support))->handle() :
                (new DomainNameSchemaResolver($this, $name))->handle()
            ;

            beyond_copy_stub(
                $stub,
                $schema->path('Traits'),
                [
                    '{{ namespace }}' => $schema->namespace(),
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
