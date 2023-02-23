<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakePolicyCommand extends DomainCommand
{
    protected $signature = 'beyond:make:policy {name} {--model=} {--force}';

    protected $description = 'Make a new policy';

    protected function getRefactoringParameters(): array
    {
        return [
            '{{ modelName }}' => $model = $this->option('model'),
            '{{ modelVariable }}' => 'User' === $model ? 'object' : mb_strtolower($model),
        ];
    }

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
}
