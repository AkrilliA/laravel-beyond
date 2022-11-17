<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeDataTransferObjectFactoryCommand extends BaseCommand
{
    protected $signature = 'beyond:make:dto-factory {name?} {--force} {--dto=}';

    protected $description = 'Make a new data transfer object factory';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');
            $dto = $this->option('dto');

            $stub = $dto ? 'data-transfer-object-factory.stub' : 'data-transfer-object-factory.plain.stub';

            $schema = (new AppNameSchemaResolver($this, $name))->handle();
            $dtoSchema = $dto ? (new DomainNameSchemaResolver($this, $dto))->handle() : null;

            beyond_copy_stub(
                $stub,
                $schema->path('Factories'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                    '{{ dtoNamespace }}' => $dtoSchema?->namespace(),
                    '{{ dtoClassName }}' => $dtoSchema?->className(),
                ],
                $force
            );

            $this->components->info('DTO Factory created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
