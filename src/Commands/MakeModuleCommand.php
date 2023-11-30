<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Actions\CopyDirectoryAction;
use AkrilliA\LaravelBeyond\Actions\DeletePathAction;
use AkrilliA\LaravelBeyond\Actions\MoveAndRefactorFileAction;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class MakeModuleCommand extends Command
{
    protected $signature = 'beyond:make:module {name} {--full} {--force}';

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
        $module = beyond_module_name(trim($this->argument('name')));
        $force = (bool) $this->option('force');
        $full = (bool) $this->option('full');

        $this->copyDirectoryAction->execute(
            beyond_os_aware_path(__DIR__.'/../../stubs/Module'),
            beyond_modules_path($module),
            $force,
        );

        $this->moveAndRefactorModuleFiles($module, $force);

        $this->deleteGitKeep($module, ! $full);

        $this->components->info("{$module} module created successfully.");
    }

    private function moveAndRefactorModuleFiles(string $module, bool $force = false): void
    {
        $files = [
            beyond_os_aware_path('Providers/ModuleAuthServiceProvider.stub')  => beyond_os_aware_path("Providers/{$module}AuthServiceProvider.php"),
            beyond_os_aware_path('Providers/ModuleEventServiceProvider.stub') => beyond_os_aware_path("Providers/{$module}EventServiceProvider.php"),
            beyond_os_aware_path('Providers/ModuleRouteServiceProvider.stub') => beyond_os_aware_path("Providers/{$module}RouteServiceProvider.php"),
            beyond_os_aware_path('Providers/ModuleServiceProvider.stub')      => beyond_os_aware_path("Providers/{$module}ServiceProvider.php"),
            beyond_os_aware_path('App/routes.stub')                           => beyond_os_aware_path('App/routes.php'),
        ];

        foreach ($files as $from => $to) {
            $this->moveAndRefactorFileAction->execute(
                beyond_modules_path("$module/$from"),
                beyond_modules_path("$module/$to"),
                [
                    '{{ module }}' => $module,
                ],
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
