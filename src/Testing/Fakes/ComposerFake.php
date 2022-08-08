<?php

namespace Regnerisch\LaravelBeyond\Testing\Fakes;

use Regnerisch\LaravelBeyond\Composer;

class ComposerFake extends Composer
{
    protected array $packages = [];

    public function setPackages(array $require = [], array $requireDev = []): self
    {
        $this->packages = [
            'require' => $require,
            'requireDev' => $requireDev,
        ];

        return $this;
    }
}
