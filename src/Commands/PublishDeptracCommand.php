<?php

namespace AkrilliA\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class PublishDeptracCommand extends Command
{
    protected $signature = 'beyond:publish:deptrac {--force}';

    protected $description = 'Publish the deptrac.yaml file';

    public function handle(): void
    {
        beyond_copy_stub(
            'deptrac.yaml',
            base_path('deptrac.yaml'),
            force: (bool) $this->option('force')
        );
    }
}
