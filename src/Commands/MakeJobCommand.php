<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;

class MakeJobCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:job {name} {--force}';

    protected $description = 'Make a new job';

    protected function getStub(): string
    {
        return 'job.stub';
    }

    public function getType(): string
    {
        return 'Job';
    }
}
