<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\FQN;

class MakeQueryCommand extends ApplicationCommand
{
    private FQN $modelFQN;

    protected $signature = 'beyond:make:query {name} {--model=} {--force}';

    protected $description = 'Make a new query';

    protected function getStub(): string
    {
        return $this->option('model')
            ? 'query.stub'
            : 'query.plain.stub';
    }

    public function getType(): string
    {
        return 'Query';
    }

    protected function getRefactoringParameters(): array
    {
        if ($this->option('model')) {
            return [
                '{{ modelNamespace }}' => $this->modelFQN->getNamespace(),
                '{{ modelClassName }}' => $this->modelFQN->getClassName(),
            ];
        }

        return [];
    }

    public function prepare()
    {
        if ($model = $this->option('model')) {
            $command = new MakeModelCommand();
            $this->modelFQN = $command->getFQN($model);
        }
    }

    public function onSuccess(string $namespace, string $className)
    {
        if ($this->option('model')) {
            $this->call(MakeModelCommand::class, [
                'name' => $this->modelFQN->getCommandNameArgument(),
            ]);
        }
    }
}
