<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Actions\CopyDirectoryAction;
use AkrilliA\LaravelBeyond\Actions\DeletePathAction;
use AkrilliA\LaravelBeyond\Actions\MoveAndRefactorFileAction;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class MakeModuleCommand extends Command
{
    protected $signature = 'beyond:make:module {name} {--m|minimal} {--force}';

    protected $description = 'Make a new module';

    public function __construct(
        private readonly CopyDirectoryAction $copyDirectoryAction,
        private readonly MoveAndRefactorFileAction $moveAndRefactorFileAction,
        private readonly DeletePathAction $deletePathAction
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $module = beyond_module_name($this->argument('name'));
        $force = $this->option('force') ?: false;
        $minimal = $this->option('minimal') ?: false;

        $this->copyDirectoryAction->execute(
            __DIR__.'/../../stubs/Module',
            beyond_modules_path($module)
        );

        $this->moveAndRefactorModuleFiles(
            $module,
            [
                'Providers/ModuleAuthServiceProvider.stub',
                'Providers/ModuleEventServiceProvider.stub',
                'Providers/ModuleRouteServiceProvider.stub',
                'Providers/ModuleServiceProvider.stub',
                'App/routes.stub',
            ],
            [
                "Providers/{$module}AuthServiceProvider.php",
                "Providers/{$module}EventServiceProvider.php",
                "Providers/{$module}RouteServiceProvider.php",
                "Providers/{$module}ServiceProvider.php",
                'App/routes.php',
            ],
            force: $force
        );

        $this->deleteGitKeep($module, $minimal);

        $this->components->info("{$module} module created successfully.");
    }

    private function moveAndRefactorModuleFiles(string $module, array $from, array $to, array $refactor = [], bool $force = false): void
    {
        foreach ($from as $key => $source) {
            $this->moveAndRefactorFileAction->execute(
                beyond_modules_path("{$module}/{$source}"),
                beyond_modules_path("{$module}/{$to[$key]}"),
                array_merge(
                    ['{{ module }}' => $module],
                    ! empty($refactor[$key]) ? $refactor[$key] : [],
                ),
                $force
            );
        }
    }

    private function deleteGitKeep(string $module, bool $minimal = false): void
    {
        $files = Finder::create()
            ->files()
            ->ignoreDotFiles(false)
            ->name('.gitkeep')
            ->in(beyond_modules_path($module));

        foreach ($files as $file) {
            $this->deletePathAction->execute(
                $minimal
                    ? $file->getPath()
                    : $file->getPathname()
            );
        }
    }
}
