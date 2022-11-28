<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeNotificationCommand extends BaseCommand
{
    protected $signature = 'beyond:make:notification {name?} {--queueable} {--force}';

    protected $description = 'Make a new notification';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $queueable = $this->option('queueable');
            $force = $this->option('force');

            $stub = $queueable ? 'notification.queueable.stub' : 'notification.stub';

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path('Notifications'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Notification created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
