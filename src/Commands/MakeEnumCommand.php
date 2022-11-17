<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeEnumCommand extends BaseCommand
{
    protected $signature = 'beyond:make:enum {name?} {--force}';

    protected $description = 'Make a new enum type';

    public ?int $minimumVersionId = 80100;

    public function handle()
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'enum.stub',
                $schema->path('Enums'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Enum created.');
        } catch (\Exception $e) {
            $this->components->error($e->getMessage());
        }
    }
}
