<?php

namespace Regnerisch\LaravelBeyond\Resolvers;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Actions\FetchDirectoryNamesFromPathAction;
use Regnerisch\LaravelBeyond\Schema\AppSchema;

class AppNameSchemaResolver
{
    protected bool $deprecated = false;

    protected array $parts = [];

    public function __construct(
        protected Command $command,
        protected ?string $className = null,
        protected ?string $moduleName = null,
        protected ?string $appName = null
    ) {
    }

    public function handle(): AppSchema
    {
        $action = new FetchDirectoryNamesFromPathAction();

        $appName = $this->appName;
        if (!$appName) {
            $apps = $action->execute(base_path() . '/src/App');
            do {
                $appName = $this->command->anticipate('Please enter the app name:', $apps);
            } while (!$appName);
        }

        $moduleName = $this->moduleName;
        if (!$moduleName) {
            $modules = $action->execute(base_path() . '/src/App/' . $appName);
            do {
                $moduleName = $this->command->anticipate('Please enter the module name (App/' . $appName . '):', $modules);
            } while (!$moduleName);
        }

        $className = $this->className ?? $this->command->ask('Please enter the class name:');

        return new AppSchema($appName, $moduleName, $className);
    }
}
