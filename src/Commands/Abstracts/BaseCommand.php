<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

use AkrilliA\LaravelBeyond\NameResolver;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

abstract class BaseCommand extends Command
{
    private array $placeholders = [];

    private array $onSuccess = [];

    abstract protected function getStub(): string;

    abstract public function getNamespaceTemplate(): string;

    abstract public function getType(): string;

    protected function addOnSuccess(callable $callback): void
    {
        $this->onSuccess[] = $callback;
    }

    protected function mergePlaceholders(array $array): void
    {
        $this->placeholders = array_merge(
            $this->placeholders,
            $array
        );
    }

    protected function getNameArgument(): string
    {
        return $this->argument('name');
    }

    public function getNameResolver(string $name = null): NameResolver
    {
        return new NameResolver($this, $name ?: $this->getNameArgument());
    }

    public function handle(): void
    {
        try {
            $fqn = $this->getNameResolver();

            if (method_exists($this, 'setup')) {
                $this->setup($fqn);
            }

            $refactor = array_merge(
                [
                    '{{ namespace }}' => $fqn->getNamespace(),
                    '{{ className }}' => $fqn->getClassName(),
                ],
                $this->placeholders
            );

            beyond_copy_stub(
                $this->getStub(),
                base_path($fqn->getPath()),
                $refactor,
                $this->option('force')
            );

            $this->components->info(Str::studly($this->getType())."[{$fqn->getPath()}] created successfully.");

            foreach ($this->onSuccess as $callback) {
                $callback($fqn->getNamespace(), $fqn->getClassName());
            }
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
