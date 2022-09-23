<?php

namespace Regnerisch\LaravelBeyond;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Regnerisch\LaravelBeyond\Commands\MakeActionCommand;
use Regnerisch\LaravelBeyond\Commands\MakeBuilderCommand;
use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;

class LaravelBeyondServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->app->singleton(ComposerContract::class, Composer::class);

            $this->commands([
                MakeActionCommand::class,
                MakeBuilderCommand::class,
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
            fn ($file) => 'Regnerisch\\LaravelBeyond\\Commands\\' . $file->getBasename('.php'),
            array_filter(
                $files,
                fn ($file) => !in_array($file->getBasename('.php'), $exclude, true),
            )
        );
    }
}
