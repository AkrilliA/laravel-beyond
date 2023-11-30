<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class NormalizePathAction
{
    /**
     * @param array<string>|string $path
     * @return array<string>|string
     */
    public function execute(array|string $path): array|string
    {
        $single = is_string($path);
        $paths = Arr::wrap($path);

        foreach ($paths as $k => $p) {
            $paths[$k] = Str::replace('/', DIRECTORY_SEPARATOR, $p);
        }

        if ($single) {
            return array_pop($paths);
        }

        return $paths;
    }
}
