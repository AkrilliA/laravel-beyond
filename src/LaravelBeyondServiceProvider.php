<?php

namespace Regnerisch\LaravelBeyond;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Regnerisch\LaravelBeyond\Commands\BaseCommand;
use Regnerisch\LaravelBeyond\Commands\MakeActionCommand;
use Regnerisch\LaravelBeyond\Commands\MakeBuilderCommand;
use Regnerisch\LaravelBeyond\Commands\MakeCollectionCommand;
use Regnerisch\LaravelBeyond\Commands\MakeCommand;
use Regnerisch\LaravelBeyond\Commands\MakeCommandCommand;
use Regnerisch\LaravelBeyond\Commands\MakeControllerCommand;
use Regnerisch\LaravelBeyond\Commands\MakeDataTransferObjectCommand;
use Regnerisch\LaravelBeyond\Commands\MakeDataTransferObjectFactoryCommand;
use Regnerisch\LaravelBeyond\Commands\MakeEnumCommand;
use Regnerisch\LaravelBeyond\Commands\MakeEventCommand;
use Regnerisch\LaravelBeyond\Commands\MakeJobCommand;
use Regnerisch\LaravelBeyond\Commands\MakeListenerCommand;
use Regnerisch\LaravelBeyond\Commands\MakeMiddlewareCommand;
use Regnerisch\LaravelBeyond\Commands\MakeModelCommand;
use Regnerisch\LaravelBeyond\Commands\MakePolicyCommand;
use Regnerisch\LaravelBeyond\Commands\MakeQueryCommand;
use Regnerisch\LaravelBeyond\Commands\MakeRequestCommand;
use Regnerisch\LaravelBeyond\Commands\MakeResourceCommand;
use Regnerisch\LaravelBeyond\Commands\MakeRouteCommand;
use Regnerisch\LaravelBeyond\Commands\MakeRuleCommand;
use Regnerisch\LaravelBeyond\Commands\MakeServiceProviderCommand;
use Regnerisch\LaravelBeyond\Commands\SetupCommand;
use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;
use Symfony\Component\Finder\SplFileInfo;

class LaravelBeyondServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->app->singleton(ComposerContract::class, Composer::class);

            $this->commands(...$this->beyondCommands());
        }
    }

    public function beyondCommands(): array
    {
        $exclude = [
            'BaseCommand',
        ];

        $fs = new Filesystem();
        $files = $fs->files(__DIR__ . '/Commands');

        $files = array_filter($files, function (SplFileInfo $file) use ($exclude) {
            if (in_array($file->getBasename('.php'), $exclude, true)) {
                return false;
            }

            return true;
        });

        return array_map(function ($file) {
            return 'Regnerisch\\LaravelBeyond\\Commands\\' . $file->getBasename('.php');
        }, $files);
    }
}
