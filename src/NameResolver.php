<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Commands\Abstracts\BaseCommand;
use AkrilliA\LaravelBeyond\Commands\Abstracts\SupportCommand;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

use function Laravel\Prompts\suggest;

final class NameResolver
{
    private ?string $appOrDomain = null;

    private string $namespace;

    private ?string $directory = null;

    private string $className;

    private string $path;

    public function __construct(
        private readonly BaseCommand $command,
        private readonly Stringable $name
    ) {
        $this->setAppOrDomain($this->name);
        $this->setDirectoryAndClassName($this->name->after('.'));
        $this->setNamespace();
        $this->setPath();
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    private function isGlobal(): bool
    {
        return $this->command instanceof SupportCommand
            || ($this->command->hasOption('global') && $this->command->option('global'));
    }

    private function setAppOrDomain(Stringable $name): void
    {
        $this->appOrDomain = $name->contains('.')
            ? $name->before('.')->toString()
            : null;

        if ($this->appOrDomain || $this->isGlobal()) {
            return;
        }

        $cases = match ($this->command->getAffiliation()) {
            Affiliation::APPLICATION => ['app', beyond_get_choices(base_path('src/Application'))],
            Affiliation::DOMAIN      => ['domain', beyond_get_choices(base_path('src/Domain'))],
            default                  => []
        };

        $this->appOrDomain = suggest(
            sprintf('On which %s do you want to add your %s', $cases[0], $this->command->getType()->getName()),
            function (string $value) use ($cases) {
                return collect($cases[1])->filter(fn ($o) => Str::contains($o, $value, true))->toArray();
            });
    }

    private function setDirectoryAndClassName(Stringable $name): void
    {
        $this->directory = $name->contains('/')
            ? $name->beforeLast('/')->replace('/', '\\')->toString()
            : '';
        $this->className = $name->afterLast('/')->toString();
    }

    private function setNamespace(): void
    {
        if ($this->isGlobal()) {
            $this->namespace = sprintf(
                'Support\\%s%s',
                $this->command->getType()->getNamespace(),
                $this->directory ? '\\'.$this->directory : '',
            );
        } else {
            $this->namespace = sprintf(
                $this->command->getNamespaceTemplate().'%s',
                $this->appOrDomain,
                $this->command->getType()->getNamespace(),
                $this->directory ? '\\'.$this->directory : '',
            );
        }
    }

    private function setPath(): void
    {
        $this->path = sprintf(
            '%s/'.$this->command->getFileNameTemplate(),
            Str::ucfirst(Str::replace('\\', '/', $this->namespace)),
            $this->className,
        );
    }
}
