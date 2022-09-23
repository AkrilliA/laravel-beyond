<?php

namespace Regnerisch\LaravelBeyond\Commands;

abstract class DomainGeneratorCommand extends BaseCommand
{
    public function handle(): ?bool
    {
        $stub = $this->resolveStubPath($this->getStub());

        $classNamespace = $this->getClassNamespace();
        $className = $this->getClassName();

        $path = $this->resolvePathFromNamespace($classNamespace . '\\' . $className);

        if (!$this->option('force') && $this->alreadyExists($path)) {
            $this->components->error($this->getType() . ' [' . $path . '] already exists.');

            return false;
        }

        beyond_copy_stub(
            $stub,
            $path,
            array_merge(
                [
                    '{{ namespace }}' => $classNamespace,
                    '{{ className }}' => $className,
                ],
                $this->getReplacements(),
            )
        );

        $this->components->info($className . ' [' . $path . '] created successfully.');

        return null;
    }

    protected function getClassNamespace(): string
    {
        $name = $this->getNameInput();

        $module = substr($name, 0, strpos($name, '/'));

        return 'Domain\\' . $module . '\\' . $this->getDirectoryName();
    }

    protected function getClassName(): string
    {
        $name = $this->getNameInput();

        return substr($name, strpos($name, '/') + 1);
    }
}
