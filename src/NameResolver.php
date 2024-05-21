<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Commands\Abstracts\BaseCommand;
use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

use function Laravel\Prompts\suggest;

final class NameResolver
{
    private string $appOrDomain;

    private string $namespace;

    private ?string $directory = null;

    private string $className;

    private string $path;

    public function __construct(
        private readonly BaseCommand $command,
        private readonly string $name
    ) {
        $this->init();
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getAppOrDomain(): string
    {
        return $this->appOrDomain;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getCommandNameArgument(): string
    {
        return $this->appOrDomain.'.'.$this->className;
    }

    private function init(): void
    {
        $name = new Stringable($this->name);
        $this->appOrDomain = $name->contains('.')
            ? $name->before('.')->toString()
            : null;
        $this->setDirectoryAndClassName($name->after('.'));

        if (! $this->appOrDomain) {
            $this->appOrDomain = $this->askForAppOrDomainName();
        }

        $this->namespace = sprintf(
            $this->command->getNamespaceTemplate().'%s',
            $this->appOrDomain,
            $this->command->getType()->getNamespace(),
            $this->directory ? '\\'.$this->directory : '',
        );

        $this->path = sprintf(
            '%s/'.$this->command->getFileNameTemplate(),
            Str::ucfirst(Str::replace('\\', '/', $this->namespace)),
            $this->className,
        );
    }

    private function askForAppOrDomainName(): string
    {
        $cases = match (true) {
            $this->command instanceof ApplicationCommand => ['app', beyond_get_choices(base_path('src/Application'))],
            $this->command instanceof DomainCommand      => ['domain', beyond_get_choices(base_path('src/Domain'))],
            default                                      => []
        };

        return suggest(
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
}
