<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeActionCommand extends BaseCommand
{
    protected $signature = 'beyond:make:action {name?} {--overwrite} {--queueable}';

    protected $description = 'Make a new action';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');
            $queueable = $this->option('queueable');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                $queueable ? 'action-queueable.stub' : 'action.stub',
                $schema->path('Actions'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Action created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->option('queueable')) {
            $this->requiredPackages = [
                'spatie/laravel-queueable-action',
            ];
        }

        return parent::execute($input, $output);
    }
}
