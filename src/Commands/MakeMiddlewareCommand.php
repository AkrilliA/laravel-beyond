<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeMiddlewareCommand extends Command
{
    protected $signature = 'beyond:make:middleware {className}';

    protected $description = 'Make a new middleware';

    public function handle(): void
    {
        try {
            $className = $this->argument('className');

            beyond_copy_stub(
                'middleware.stub',
                base_path() . "/src/Support/Middlewares/{$className}.php",
                [
                    '{{ className }}' => $className,
                ]
            );

            $this->info('Middleware created.');
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
