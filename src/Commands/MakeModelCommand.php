<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\NameResolver;
use AkrilliA\LaravelBeyond\Type;
use Illuminate\Support\Str;

final class MakeModelCommand extends DomainCommand
{
    protected $signature = 'beyond:make:model {name} {--f|factory} {--m|migration} {--force}';

    protected $description = 'Make a new model';

    protected function getStub(): string
    {
        return 'model.stub';
    }

    public function getType(): Type
    {
        return new Type('Model');
    }

    public function setup(NameResolver $nameResolver): void
    {
        if ($this->option('migration')) {
            $command = new MakeMigrationCommand();
            $fqn = $command->getNameResolver($nameResolver->getAppOrDomain().'.create_fake_table');

            $this->addOnSuccess(function (string $namespace, string $className) use ($fqn) {
                $this->call(MakeMigrationCommand::class, [
                    'name' => $fqn->getAppOrDomain().'.create_'.Str::of($className)->pluralStudly()->lower().'_table',
                ]);
            });

            // Add MakeFactoryCommand!
            //            if ($this->option('factory')) {
            //                $fileName = $className.'Factory';
            //
            //                beyond_copy_stub(
            //                    'factory.stub',
            //                    base_path()."/modules/$module/Infrastructure/factories/$fileName.php",
            //                    [
            //                        '{{ namespace }}' => $namespace,
            //                        '{{ model }}'     => $fileName,
            //                    ],
            //                    $force
            //                );
            //            }
        }
    }
}
