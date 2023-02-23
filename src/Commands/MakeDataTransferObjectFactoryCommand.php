<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\FQN;

class MakeDataTransferObjectFactoryCommand extends ApplicationCommand
{
    private FQN $dtoFQN;

    protected $signature = 'beyond:make:dto-factory {name?} {--force} {--dto=}';

    protected $description = 'Make a new data transfer object factory';

    public function getType(): string
    {
        return 'Factory';
    }

    protected function getStub(): string
    {
        return $this->option('dto')
            ? 'data-transfer-object-factory.stub'
            : 'data-transfer-object-factory.plain.stub';
    }

    protected function getRefactoringParameters(): array
    {
        if ($this->option('dto')) {
            return [
                '{{ dtoNamespace }}' => $this->dtoFQN->getNamespace(),
                '{{ dtoClassName }}' => $this->dtoFQN->getClassName(),
            ];
        }

        return [];
    }

    public function prepare()
    {
        if ($dto = $this->option('dto')) {
            $command = new MakeDataTransferObjectCommand();
            $this->dtoFQN = $command->getFQN($dto);
        }
    }

    public function onSuccess(string $namespace, string $className)
    {
        if ($this->option('dto')) {
            $this->call(MakeDataTransferObjectCommand::class, [
                'name' => $this->dtoFQN->getCommandNameArgument(),
            ]);
        }
    }
}
