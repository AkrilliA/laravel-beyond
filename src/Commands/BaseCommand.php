<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\FQN;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

abstract class BaseCommand extends Command
{
    abstract public function getNamespaceTemplate(): string;

    abstract protected function getStub(): string;

    abstract public function getType(): string;

    // TODO: Find a more suitable name.
    public function getPluralizedType(): string
    {
        return Str::pluralStudly($this->getType());
    }

    protected function getRefactoringParameters(): array
    {
        return [];
    }

    protected function getNameArgument(): string
    {
        return $this->argument('name');
    }

    public function getFQN(string $name = null): FQN
    {
        return new FQN($this, $name ?: $this->getNameArgument());
    }

    public function handle(): void
    {
        if (method_exists($this, 'prepare')) {
            $this->prepare();
        }

        try {
            $fqn = $this->getFQN();

            $refactor = array_merge(
                [
                    '{{ namespace }}' => $fqn->getNamespace(),
                    '{{ className }}' => $fqn->getClassName(),
                ],
                $this->getRefactoringParameters()
            );

            beyond_copy_stub(
                $this->getStub(),
                base_path($fqn->getPath()),
                $refactor,
                $this->option('force')
            );

            $this->components->info(Str::studly($this->getType())."[{$fqn->getPath()}] created successfully.");

            if (method_exists($this, 'onSuccess')) {
                $this->onSuccess($fqn->getNamespace(), $fqn->getClassName());
            }
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
