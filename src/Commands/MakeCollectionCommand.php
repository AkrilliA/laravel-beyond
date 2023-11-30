<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\NameResolver;
use AkrilliA\LaravelBeyond\Type;

class MakeCollectionCommand extends DomainCommand
{
    protected $signature = 'beyond:make:collection {name} {--model=} {--force}';

    protected $description = 'Make a new collection';

    protected function getStub(): string
    {
        return $this->hasOption('model')
            ? 'collection.stub'
            : 'collection.plain.stub';
    }

    public function getType(): Type
    {
        return new Type('Collection');
    }

    public function setup(NameResolver $fqn): void
    {
        if ($model = $this->option('model')) {
            $command = new MakeModelCommand();
            $fqn = $command->getNameResolver($fqn->getModule().'.'.$model);

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
