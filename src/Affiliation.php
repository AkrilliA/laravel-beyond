<?php

namespace AkrilliA\LaravelBeyond;

enum Affiliation: string
{
    case APPLICATION = 'Application';
    case DOMAIN = 'Domain';
    case SUPPORT = 'Support';

    public function toNamespaceTemplate(): string
    {
        return match ($this) {
            self::APPLICATION, self::DOMAIN => $this->value.'\\%s\\%s',
            self::SUPPORT => $this->value.'\\%s',
        };
    }
}
