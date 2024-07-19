<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Affiliation;
use AkrilliA\LaravelBeyond\Commands\Abstracts\BaseCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakePolicyCommand extends BaseCommand
{
    protected $signature = 'beyond:make:policy {name} {--force}';

    protected $description = 'Make a new policy';

    public function getAffiliation(): Affiliation
    {
        if (file_exists(beyond_support_path('Beyond/Gate.php'))) {
            return Affiliation::APPLICATION;
        }

        return Affiliation::DOMAIN;
    }

    protected function getStub(): string
    {
        return 'policy.stub';
    }

    public function getType(): Type
    {
        return new Type('Policy');
    }
}
