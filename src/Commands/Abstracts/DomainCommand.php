<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

use AkrilliA\LaravelBeyond\Affiliation;

abstract class DomainCommand extends BaseCommand
{
    public function getAffiliation(): Affiliation
    {
        return Affiliation::DOMAIN;
    }
}
