<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Regnerisch\LaravelBeyond\Commands\MakeActionCommand;
use Regnerisch\LaravelBeyond\Commands\MakeBuilderCommand;
use Regnerisch\LaravelBeyond\Commands\MakeCollectionCommand;
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
use Regnerisch\LaravelBeyond\Commands\MakeRuleCommand;
use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;

class LaravelBeyondServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->app->singleton(ComposerContract::class, Composer::class);

            $this->commands([
                MakeActionCommand::class,
//                MakeBuilderCommand::class,
//                MakeCollectionCommand::class,
//                MakeControllerCommand::class,
                MakeDataTransferObjectCommand::class,
                MakeDataTransferObjectFactoryCommand::class,
//                MakeEnumCommand::class,
//                MakeEventCommand::class,
//                MakeJobCommand::class,
//                MakeListenerCommand::class,
//                MakeMiddlewareCommand::class,
//                MakeModelCommand::class,
//                MakePolicyCommand::class,
//                MakeQueryCommand::class,
//                MakeRequestCommand::class,
//                MakeResourceCommand::class,
//                MakeRuleCommand::class,
            ]);

            // $this->commands(...$this->beyondCommands());
        }
    }

    public function beyondCommands(): array
    {
        $exclude = [
            'ApplicationGeneratorCommand',
            'BaseCommand',
            'DomainGeneratorCommand',
        ];

        $fs = new Filesystem();
        $files = $fs->files(__DIR__ . '/Commands');

        return array_map(
            fn ($file) => 'AkrilliA\\LaravelBeyond\\Commands\\' . $file->getBasename('.php'),
            array_filter(
                $files,
                fn ($file) => !in_array($file->getBasename('.php'), $exclude, true),
            )
        );
    }
}
