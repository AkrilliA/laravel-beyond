<?php

namespace Regnerisch\LaravelBeyond;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
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
