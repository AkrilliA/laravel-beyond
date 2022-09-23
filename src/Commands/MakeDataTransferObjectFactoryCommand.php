<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeDataTransferObjectFactoryCommand extends BaseCommand
{
    protected $signature = 'beyond:make:dto-factory {name?} {--overwrite} {--dto=}';

    protected $description = 'Make a new data transfer object factory';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');
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
                $overwrite
            );

            $this->components->info('DTO Factory created.');

            if ($dto) {
                $this->call(MakeDataTransferObjectCommand::class, ['name' => $dto]);
            }
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
