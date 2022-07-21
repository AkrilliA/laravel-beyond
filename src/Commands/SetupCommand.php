<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Regnerisch\LaravelBeyond\Actions\ChangeComposerAutoloaderAction;
use Regnerisch\LaravelBeyond\Actions\CopyAndRefactorDirectoryAction;
use Regnerisch\LaravelBeyond\Actions\CopyAndRefactorFileAction;
use Regnerisch\LaravelBeyond\Actions\DeleteAction;
use Regnerisch\LaravelBeyond\Actions\RefactorFileAction;

class SetupCommand extends Command
{
    protected $signature = 'beyond:setup {--skip-delete} {--overwrite}';

    protected $description = '';

    public function __construct(
        protected CopyAndRefactorFileAction $copyAndRefactorFileAction,
        protected CopyAndRefactorDirectoryAction $copyAndRefactorDirectoryAction,
        protected RefactorFileAction $refactorFileAction,
        protected ChangeComposerAutoloaderAction $changeComposerAutoloaderAction,
        protected DeleteAction $deleteAction,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $skipDelete = $this->option('skip-delete');
        $overwrite = $this->option('overwrite');

        // Console
        $this->copyAndRefactorFileAction->execute(
            base_path() . '/app/Console/Kernel.php',
            base_path() . '/src/App/Console/Kernel.php',
            overwrite: $overwrite
        );

        // Exceptions
        $this->copyAndRefactorFileAction->execute(
            base_path() . '/app/Exceptions/Handler.php',
            base_path() . '/src/App/Exceptions/Handler.php',
            overwrite: $overwrite
        );

        // Middlewares
        $this->moveMiddlewares($overwrite);

        // Http Kernel
        $this->copyAndRefactorFileAction->execute(
            base_path() . '/app/Http/Kernel.php',
            base_path() . '/src/App/HttpKernel.php',
            [
                'namespace App\Http;' => 'namespace App;',
                'use Illuminate\Foundation\Http\Kernel as HttpKernel;' => 'use Illuminate\Foundation\Http\Kernel;',
                'class Kernel extends HttpKernel' => 'class HttpKernel extends Kernel',
                '\App\Http\Middleware\\' => '\Support\Packages\Laravel\Middlewares\\',
            ],
            $overwrite
        );

        // Application
        beyond_copy_stub(
            'application.stub',
            base_path() . '/src/App/Application.php',
            overwrite: $overwrite
        );

        // Models
        $this->copyAndRefactorFileAction->execute(
            base_path() . '/app/Models/User.php',
            base_path() . '/src/Domain/Users/Models/User.php',
            [
                'namespace App\Models;' => 'namespace Domain\Users\Models;',
            ],
            $overwrite
        );

        // Providers
        $this->moveProviders($overwrite);

        // Bootstrap
        $this->prepareBootstrap();

        // Rewrite configs
        $this->refactorFileAction->execute(
            base_path() . '/config/auth.php',
            [
                'App\Models\User::class' => 'Domain\Users\Models\User::class',
            ]
        );

        // Composer Autoloader
        $this->changeComposerAutoloaderAction->execute();

        if (!$skipDelete) {
            // Delete app folder
            $this->deleteAction->execute(base_path() . '/app');
        }

        $this->info('Setup completed.');
        $this->info(
            'Do not forget to add following code into the boot() function of your AppServiceProvider:' . PHP_EOL . PHP_EOL .

            'Factory::guessFactoryNamesUsing(function (string $modelName) {' . PHP_EOL .
                "\t" . 'return \'Database\\Factories\\\' . class_basename($modelName) . \'Factory\';' . PHP_EOL .
            '});' . PHP_EOL
        );
    }

    protected function moveMiddlewares(bool $overwrite = false): void
    {
        $this->copyAndRefactorDirectoryAction->execute(
            base_path() . '/app/Http/Middleware',
            base_path() . '/src/Support/Packages/Laravel/Middlewares',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Packages\Laravel\Middlewares;',
            ],
            $overwrite
        );
    }

    protected function moveProviders(bool $overwrite = false): void
    {
        $fs = new Filesystem();
        $providers = $fs->files(base_path() . '/app/Providers');

        foreach ($providers as $provider) {
            $this->copyAndRefactorFileAction->execute(
                base_path() . '/app/Providers/' . $provider->getFilename(),
                base_path() . '/src/App/Providers/' . $provider->getFilename(),
                overwrite: $overwrite
            );
        }
    }

    protected function prepareBootstrap(): void
    {
        $this->refactorFileAction->execute(
            base_path() . '/bootstrap/app.php',
            [
                'new Illuminate\Foundation\Application' => 'new App\Application',
                'App\Http\Kernel::class' => 'App\HttpKernel::class',
            ]
        );
    }
}
