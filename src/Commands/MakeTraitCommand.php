<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeTraitCommand extends BaseCommand
{
    protected $signature = 'beyond:make:trait {name?} {--support} {--overwrite}';

    protected $description = 'Make a new trait';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $support = $this->option('support');
            $overwrite = $this->option('overwrite');

            $stub = $support ? 'trait.support.stub' : 'trait.stub';
            $directory = $support ? 'Packages/Laravel/Traits' : 'Traits';

            $schema = (new AppNameSchemaResolver($this, $name, support: $support))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path($directory),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Trait created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
