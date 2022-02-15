<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\IOException;

class ReplaceFileContentAction
{
    public function execute(string $path, array $replacements): void
    {
        $fs = new Filesystem();

        if (!$fs->exists($path)) {
            throw new FileNotFoundException("$path not found");
        }

        if (!$fs->isReadable($path)) {
            throw new IOException("$path is not readable.");
        }

        if (!$fs->isWritable($path)) {
            throw new IOException("$path is not writable.");
        }

        $content = $fs->get($path);

        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        $fs->put($path, $content);
    }
}
