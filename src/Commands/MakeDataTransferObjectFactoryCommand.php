<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\NameResolver;

class MakeDataTransferObjectFactoryCommand extends ApplicationCommand
{
    private NameResolver $dtoFQN;

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

    public function setup(NameResolver $nameResolver): void
    {
        if ($dto = $this->option('dto')) {
            $command = new MakeDataTransferObjectCommand();
            $fqn = $command->getNameResolver($nameResolver->getModule().'/'.$dto);

            $this->mergePlaceholders([
                '{{ dtoNamespace }}' => $fqn->getNamespace(),
                '{{ dtoClassName }}' => $fqn->getClassName(),
            ]);

            $this->addOnSuccess(function (string $namespace, string $className) use ($fqn) {
                $this->call(MakeDataTransferObjectCommand::class, [
                    'name' => $fqn->getCommandNameArgument(),
                ]);
            });
        }
    }
}
