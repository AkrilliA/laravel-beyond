<?php

namespace AkrilliA\LaravelBeyond;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use AkrilliA\LaravelBeyond\Commands\MakeActionCommand;
use AkrilliA\LaravelBeyond\Commands\MakeBuilderCommand;
use AkrilliA\LaravelBeyond\Commands\MakeCollectionCommand;
use AkrilliA\LaravelBeyond\Commands\MakeControllerCommand;
use AkrilliA\LaravelBeyond\Commands\MakeDataTransferObjectCommand;
use AkrilliA\LaravelBeyond\Commands\MakeDataTransferObjectFactoryCommand;
use AkrilliA\LaravelBeyond\Commands\MakeEnumCommand;
use AkrilliA\LaravelBeyond\Commands\MakeEventCommand;
use AkrilliA\LaravelBeyond\Commands\MakeJobCommand;
use AkrilliA\LaravelBeyond\Commands\MakeListenerCommand;
use AkrilliA\LaravelBeyond\Commands\MakeMiddlewareCommand;
use AkrilliA\LaravelBeyond\Commands\MakeModelCommand;
use AkrilliA\LaravelBeyond\Commands\MakePolicyCommand;
use AkrilliA\LaravelBeyond\Commands\MakeQueryCommand;
use AkrilliA\LaravelBeyond\Commands\MakeRequestCommand;
use AkrilliA\LaravelBeyond\Commands\MakeResourceCommand;
use AkrilliA\LaravelBeyond\Commands\MakeRuleCommand;
use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;

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
