<?php

namespace AkrilliA\LaravelBeyond\Testing\Fakes;

use AkrilliA\LaravelBeyond\Composer;

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
