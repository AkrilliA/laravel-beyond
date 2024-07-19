<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

use AkrilliA\LaravelBeyond\Affiliation;

abstract class SupportCommand extends BaseCommand
{
    public function getAffiliation(): Affiliation
    {
        return Affiliation::SUPPORT;
    }
}
