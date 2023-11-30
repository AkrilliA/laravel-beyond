<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Commands\Abstracts\BaseCommand;
use AkrilliA\LaravelBeyond\Exceptions\InvalidNameException;
use AkrilliA\LaravelBeyond\Exceptions\ModuleDoesNotExistsException;
use Illuminate\Support\Str;

class NameResolver
{
    private string $module;

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

    public function getModule(): string
    {
        return $this->module;
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
        return $this->module.'.'.$this->className;
    }

    private function init(): void
    {
        $parts = explode('.', $this->name);
        $numParts = count($parts);
        $modules = beyond_get_choices(base_path('modules'));

        if ($numParts === 1) {
            $this->module = $this->command->choice(
                'On which module should we create your '.$this->command->getType()->getName().'?',
                $modules,
                attempts: 2
            );

            $this->setDirectoryAndClassName($parts[0]);
        } elseif ($numParts === 2) {
            $module = Str::of($parts[0])->ucfirst()->value();
            if (! in_array($module, $modules, true)) {
                throw new ModuleDoesNotExistsException($module);
            }

            $this->module = $module;
            $this->setDirectoryAndClassName($parts[1]);
        } else {
            throw new InvalidNameException($this->name);
        }

        $this->namespace = sprintf(
            $this->command->getNamespaceTemplate().'%s',
            $this->module,
            $this->command->getType()->getNamespace(),
            $this->directory ? '\\'.$this->directory : '',
        );

        $this->path = sprintf(
            '%s/'.$this->command->getFileNameTemplate(),
            Str::lcfirst(Str::replace('\\', '/', $this->namespace)),
            $this->className,
        );
    }

    private function setDirectoryAndClassName(string $name): void
    {
        $parts = explode('/', $name);

        $this->className = array_pop($parts);

        $this->directory = implode('\\', $parts);
    }
}
