<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Commands\Abstracts\BaseCommand;
use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\Commands\Abstracts\InfrastructureCommand;
use AkrilliA\LaravelBeyond\Exceptions\AppDoesNotExistsException;
use AkrilliA\LaravelBeyond\Exceptions\InvalidNameException;
use Illuminate\Support\Str;

use function Laravel\Prompts\search;
use function Laravel\Prompts\suggest;

final class NameResolver
{
    private string $appOrDomain;

    private string $namespace;

    private string $directory;

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
        $parts = explode('.', $this->name);
        $numParts = count($parts);
        $commandType = match (true) {
            $this->command instanceof ApplicationCommand    => 'APP',
            $this->command instanceof DomainCommand         => 'DOMAIN',
            $this->command instanceof InfrastructureCommand => 'INFRASTRUCTURE',
            default                                         => 'UNKNOWN'
        };

        if ($numParts === 1) {
            $this->appOrDomain = $this->askForAppOrDomainName($commandType);
        } elseif ($numParts === 2) {
            $appOrDomain = Str::of($parts[0])->lower()->ucfirst()->value();

            if ($commandType === 'APP' && ! $this->isExistingApp($appOrDomain)) {
                throw new AppDoesNotExistsException($parts[0]);
            }

            $this->appOrDomain = $appOrDomain;
            $this->setDirectoryAndClassName($parts[1]);
        } else {
            throw new InvalidNameException($this->name);
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

    private function askForAppOrDomainName(string $commandType): string
    {
        $cases = match ($commandType) {
            'APP'            => ['app', beyond_get_choices(base_path('src/Application')), 'askForAppName'],
            'DOMAIN'         => ['domain', beyond_get_choices(base_path('src/Domain')), 'askForDomainName'],
            'INFRASTRUCTURE' => ['infrastructure', beyond_get_choices('src/Infrastructure'), 'askForDomainName'],
            default          => []
        };

        $question = sprintf('On which %s do you want to add your %s', $cases[0], $this->command->getType()->getName());

        return $this->{$cases[2]}($question, $cases[1]);
    }

    /**
     * @param  array<string>  $options
     */
    private function askForAppName(string $question, array $options): string
    {
        return search(
            $question,
            function (string $value) use ($options) {
                if ($value !== '') {
                    return collect($options)->filter(fn ($o) => Str::contains($o, $value, true));
                }

                return $options;
            },
            validate: function (string $value) use ($options) {
                if (! in_array($value, $options, true)) {
                    return 'The given app does not exist.';
                }
            }
        );
    }

    /**
     * @param  array<int, string>  $options
     */
    private function askForDomainName(string $question, array $options): string
    {
        return suggest(
            $question,
            function (string $value) use ($options) {
                return collect($options)->filter(fn ($o) => Str::contains($o, $value, true))->toArray();
            }
        );
    }

    private function isExistingApp(string $app): bool
    {
        $apps = beyond_get_choices(base_path('src/Application'));

        return in_array($app, $apps, true);
    }

    private function setDirectoryAndClassName(string $name): void
    {
        $parts = explode('/', $name);

        $this->className = array_pop($parts);

        $this->directory = implode('\\', $parts);
    }
}
