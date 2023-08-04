<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\NameResolver;
use Illuminate\Support\Str;

class MakePolicyCommand extends DomainCommand
{
    protected $signature = 'beyond:make:policy {name} {--model=} {--force}';

    protected $description = 'Make a new policy';

    protected function getStub(): string
    {
        return $this->option('model')
            ? 'policy.stub'
            : 'policy.plain.stub';
    }

    public function getType(): string
    {
        return 'Policy';
    }

    public function setup(NameResolver $fqn): void
    {
        if ($model = $this->option('model')) {
            $command = new MakeModelCommand();
            $fqn = $command->getNameResolver($fqn->getModule().'/'.$model);

            $this->mergePlaceholders([
                '{{ modelNamespace }}' => $fqn->getNamespace(),
                '{{ modelClassName }}' => $fqn->getClassName(),
                '{{ modelVariable }}' => Str::camel($fqn->getClassName())
            ]);
        }
    }
}
