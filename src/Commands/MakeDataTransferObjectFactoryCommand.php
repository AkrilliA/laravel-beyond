<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\ApplicationGeneratorCommand;
use AkrilliA\LaravelBeyond\WithDomainResolver;

class MakeDataTransferObjectFactoryCommand extends ApplicationGeneratorCommand
{
    use WithDomainResolver;

    protected $signature = 'beyond:make:dto-factory {name?} {--force} {--dto=}';

    protected $description = 'Make a new data transfer object factory';

    protected string $type = 'Factory';

    protected function getStub(): string
    {
        if ($this->option('dto')) {
            return '/stubs/beyond.dto-factory.stub';
        }

        return '/stubs/beyond.dto-factory.plain.stub';
    }

    protected function getReplacements(): array
    {
        if ($dto = $this->option('dto')) {
            $dtoSchema = $this->getDomainSchemaFromName($dto, 'DataTransferObject');
            $dtoNamespace = $this->getDomainNamespaceFromSchema($dtoSchema, 'DataTransferObjects');
            $dtoClassName = $this->getClassNameFromSchema($dtoSchema);
            $this->addAdditionalHandler(function ($code) use ($dtoSchema) {
                $this->call('beyond:make:dto', ['name' => $dtoSchema]);
            });
        }

        return [
            '{{ dtoNamespace }}' => $dtoNamespace ?? null,
            '{{ dtoClassName }}' => $dtoClassName ?? null,
        ];
    }
}
