<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;
use Illuminate\Filesystem\Filesystem;

class Composer implements ComposerContract
{
    protected static ?self $instance = null;

    protected array $packages = [];

    public function isPackageInstalled(string $name, bool $withRequireDev = false): bool
    {
        [
            'require' => $require,
            'requireDev' => $requireDev
        ] = $this->getPackages();

        if (in_array($name, $require, true)) {
            return true;
        }

        if ($withRequireDev && in_array($name, $requireDev, true)) {
            return true;
        }

        return false;
    }

    public function getPackages(): array
    {
        if (! empty($this->packages)) {
            return $this->packages;
        }

        $content = (new Filesystem())->get(base_path().'/composer.json');
        $json = json_decode($content, true);

        return $this->packages = [
            'require' => array_keys($json['require']),
            'requireDev' => array_keys($json['require-dev']),
        ];
    }
}
