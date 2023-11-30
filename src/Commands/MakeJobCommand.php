<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

class MakeJobCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:job {name} {--sync} {--force}';

    protected $description = 'Make a new job';

    protected function getStub(): string
    {
        return match (true) {
            $this->option('sync') => 'job.sync.stub',
            default               => 'job.stub'
        };
    }

    public function getType(): Type
    {
        return new Type('Job');
    }
}
