<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakePolicyCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:policy {name?} {--model=} {--force}';

    protected $description = 'Make a new policy';

    protected function getStub(): string
    {
        if ($this->option('model')) {
            return 'stubs/beyond.policy.model.stub';
        }

        return 'stubs/beyond.policy.stub';
    }

    protected function getReplacements(): array
    {
        if ($model = $this->option('model')) {
            $modelName = $model;
            $modelNamespace = Str::plural($model);
            $modelVariable = 'User' === $model ? 'object' : Str::lower($model);
        }

        return [
            '{{ modelNamespace }}' => $modelNamespace ?? null,
            '{{ modelName }}' => $modelName ?? null,
            '{{ modelVariable }}' => $modelVariable ?? null,
        ];
    }

    protected function getType(): string
    {
        return 'Policy';
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the action already exists'],
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The model that the policy is for'],
        ];
    }
}
