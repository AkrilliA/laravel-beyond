<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeActionCommand extends BaseCommand
{
    protected $signature = 'beyond:make:action {name?} {--force} {--queueable}';

    protected $description = 'Make a new action';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');
            $queueable = $this->option('queueable');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                $queueable ? 'action.queueable.stub' : 'action.stub',
                $schema->path('Actions'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
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
