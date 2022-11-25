<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

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
        $files = $fs->files(__DIR__.'/Commands');

        return array_map(
            fn ($file) => 'AkrilliA\\LaravelBeyond\\Commands\\'.$file->getBasename('.php'),
            array_filter(
                $files,
                fn ($file) => ! in_array($file->getBasename('.php'), $exclude, true),
            )
        );
    }
}
