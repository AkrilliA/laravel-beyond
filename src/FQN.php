<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Commands\BaseCommand;
use Illuminate\Support\Str;

class FQN
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

        if (1 === count($parts)) {
            $this->module = $this->command->anticipate(
                'On which module should we create your '.Str::studly($this->command->getType()).'?',
                beyond_get_choices(base_path('modules'))
            );
            $this->className = $parts[0];
        } else {
            $this->module = $parts[0];
            $this->className = $parts[1];
        }

        $this->namespace = sprintf(
            $this->command->getNamespaceTemplate(),
            $this->module,
            $this->command->getPluralizedType(),
        );

        $this->path = Str::lcfirst(Str::replace('\\', '/', $this->namespace))."/{$this->className}.php";
    }
}
