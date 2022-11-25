<?php

namespace AkrilliA\LaravelBeyond\Resolvers;

use AkrilliA\LaravelBeyond\Actions\FetchDirectoryNamesFromPathAction;
use AkrilliA\LaravelBeyond\Contracts\Schema;
use AkrilliA\LaravelBeyond\Schema\AppSchema;
use AkrilliA\LaravelBeyond\Schema\SupportSchema;
use Illuminate\Console\Command;

class AppNameSchemaResolver extends BaseNameSchemaResolver
{
    public function __construct(
        protected Command $command,
        protected ?string $className = null,
        protected ?string $moduleName = null,
        protected ?string $appName = null,
        protected bool $support = false,
    ) {
        parent::__construct($this->command, $this->className, $this->support);
    }

    public function handle(): Schema
    {
        if ($this->support) {
            $className = $this->askClassName();

            return new SupportSchema('', $className);
        }

        [$namespace, $className] = $this->namespaceAndClassName();
        $namespace = $namespace ?? $this->askNamespace();
        $className = $className ?? $this->askClassName();

        return new AppSchema($namespace, $className);
    }

    protected function askNamespace(): string
    {
        $fetchDirectoryNamesFromPathAction = new FetchDirectoryNamesFromPathAction();

        $appName = $this->appName;
        if (! $appName) {
            $apps = $fetchDirectoryNamesFromPathAction->execute(base_path().'/src/App');
            do {
                $appName = $this->command->anticipate('Please enter the app name', $apps);
            } while (! $appName);
        }

        $moduleName = $this->moduleName;
        if (! $moduleName) {
            $modules = $fetchDirectoryNamesFromPathAction->execute(base_path().'/src/App/'.$appName);
            do {
                $moduleName = $this->command->anticipate('Please enter the module name (in App/'.$appName.')', $modules);
            } while (! $moduleName);
        }

        return $appName.'/'.$moduleName;
    }

    protected function askClassName(): string
    {
        do {
            $className = $this->className ?? $this->command->ask('Please enter the class name');
        } while (! $className);

        return $className;
    }
}
