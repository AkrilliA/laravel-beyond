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
        return $this->module.'/'.$this->className;
    }

    private function init()
    {
        $parts = explode('/', $this->name);
        $numParts = count($parts);
        $modules = beyond_get_choices(base_path('modules'));

        if (1 === $numParts) {
            $this->module = $this->command->choice(
                'On which module should we create your '.Str::studly($this->command->getType()).'?',
                $modules,
                3
            );
            $this->className = $parts[0];
        } elseif (2 === $numParts) {
            $module = Str::of($parts[0])->ucfirst()->value();
            if (! in_array($module, $modules)) {
                throw new ModuleDoesNotExistsException($module);
            }

            $this->module = $module;
            $this->className = $parts[1];
        } else {
            throw new InvalidNameException($this->name);
        }

        $this->namespace = sprintf(
            $this->command->getNamespaceTemplate(),
            $this->module,
            Str::pluralStudly($this->command->getType()),
        );

        $this->path = Str::lcfirst(Str::replace('\\', '/', $this->namespace))."/{$this->className}.php";
    }
}