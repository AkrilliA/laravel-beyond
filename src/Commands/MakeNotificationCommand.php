<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeNotificationCommand extends DomainCommand
{
    protected $signature = 'beyond:make:notification {name} {--force}';

    protected $description = 'Make a new notification';

    protected function getStub(): string
    {
        return 'notification.stub';
    }

    public function getType(): string
    {
        return 'Notification';
    }
}
