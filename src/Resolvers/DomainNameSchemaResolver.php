<?php

namespace Regnerisch\LaravelBeyond\Resolvers;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Actions\FetchDirectoryNamesFromPathAction;
use Regnerisch\LaravelBeyond\Schema\DomainSchema;

class DomainNameSchemaResolver
{
    protected string $app;

    protected string $module;

    public function __construct(
        protected Command $command,
        protected ?string $className = null,
    )
    {
    }

    public function handle(): DomainSchema
    {
        $action = new FetchDirectoryNamesFromPathAction();
        $domains = $action->execute(base_path() . '/src/Domain');

        do {
            $domainName = $this->command->anticipate('Please enter the domain name:', $domains);
        } while(!$domainName);

        do {
            $className = $this->className ?? $this->command->ask('Please enter the class name:');
        } while(!$className);

        return new DomainSchema($domainName, $className);
    }
}
