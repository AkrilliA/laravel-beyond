<?php

namespace AkrilliA\LaravelBeyond\Resolvers;

use AkrilliA\LaravelBeyond\Actions\FetchDirectoryNamesFromPathAction;
use AkrilliA\LaravelBeyond\Contracts\Schema;
use AkrilliA\LaravelBeyond\Schema\DomainSchema;
use AkrilliA\LaravelBeyond\Schema\SupportSchema;

class DomainNameSchemaResolver extends BaseNameSchemaResolver
{
    public function handle(): Schema
    {
        if ($this->support) {
            $className = $this->askClassName();

            return new SupportSchema('', $className);
        }

        [$namespace, $className] = $this->namespaceAndClassName();
        $namespace = $namespace ?? $this->askNamespace();
        $className = $className ?? $this->askClassName();

        return new DomainSchema($namespace, $className);
    }

    protected function askNamespace(): string
    {
        $fetchDirectoryNamesFromPathAction = new FetchDirectoryNamesFromPathAction();
        $domains = $fetchDirectoryNamesFromPathAction->execute(base_path().'/src/Domain');

        do {
            $domainName = $this->command->anticipate('Please enter the domain name', $domains);
        } while (! $domainName);

        return $domainName;
    }

    protected function askClassName(): string
    {
        return $this->className ?? $this->command->ask('Please enter the class name');
    }
}
