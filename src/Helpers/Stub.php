<?php

namespace Regnerisch\LaravelBeyond\Helpers;

use Symfony\Component\Filesystem\Filesystem;

class Stub
{
    public static function makeFromTemplate(string $template, string $path, array $variables = []): void
    {
        $fs = new Filesystem();
        $fs->copy(
            __DIR__ . "/../../stubs/{$template}",
            $path,
        );

        file_put_contents(
            $path,
            str_replace(
                array_keys($variables),
                $variables,
                file_get_contents($path)
            )
        );
    }
}
