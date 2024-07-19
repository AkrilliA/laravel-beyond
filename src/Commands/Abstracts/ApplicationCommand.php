<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

use AkrilliA\LaravelBeyond\Affiliation;

abstract class ApplicationCommand extends BaseCommand
{
    public function getAffiliation(): Affiliation
    {
        return Affiliation::APPLICATION;
    }
}
