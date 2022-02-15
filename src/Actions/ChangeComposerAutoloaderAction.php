<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\IOException;

class ChangeComposerAutoloaderAction
{
    public function execute()
    {
        $path = app_path() . '/composer.json';

        $fs = new Filesystem();

        if (false === $fs->exists($path)) {
            throw new FileNotFoundException('composer.json not found.');
        }

        if (false === $fs->isReadable($path)) {
            throw new IOException('composer.json is not readable.');
        }

        if (false === $fs->isWritable($path)) {
            throw new IOException('composer.json is not writable');
        }

        $namespaces = [
            'App\\' => 'src/App/',
            'Domain\\' => 'src/Domain/',
            'Support\\' => 'src/Support/'
        ];

        $composer = json_decode($fs->get($path));

        foreach ($namespaces as $namespace => $path) {
            $composer->autoload->{'psr-4'}->{$namespace} = $path;
        }

        $composer = json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $fs->put($path, $composer);
    }
}
