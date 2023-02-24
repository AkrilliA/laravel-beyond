<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\NameResolver;

class MakeQueryCommand extends ApplicationCommand
{
    private NameResolver $modelFQN;

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

    public function setup(NameResolver $nameResolver): void
    {
        if ($model = $this->option('model')) {
            $command = new MakeModelCommand();
            $fqn = $command->getNameResolver($nameResolver->getModule().'/'.$model);

            $this->mergePlaceholders([
                '{{ modelNamespace }}' => $fqn->getNamespace(),
                '{{ modelClassName }}' => $fqn->getClassName(),
            ]);

            $this->addOnSuccess(function (string $namespace, string $className) use ($fqn) {
                $this->call(MakeModelCommand::class, [
                    'name' => $fqn->getCommandNameArgument(),
                ]);
            });
        }
    }
}
