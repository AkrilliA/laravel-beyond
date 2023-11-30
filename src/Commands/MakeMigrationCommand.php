<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\InfrastructureCommand;
use AkrilliA\LaravelBeyond\NameResolver;
use AkrilliA\LaravelBeyond\Type;
use Illuminate\Database\Console\Migrations\TableGuesser;
use Illuminate\Support\Str;

class MakeMigrationCommand extends InfrastructureCommand
{
    protected $signature = 'beyond:make:migration {name} {--force}';

    protected $description = 'Make a new migration';

    private string $stub;

    protected function getStub(): string
    {
        return $this->stub;
    }

    public function getType(): Type
    {
        return new Type('Database/Migration');
    }

    public function getFileNameTemplate(): string
    {
        $now = new \DateTime();

        return $now->format('Y_m_d_His').'_%s.php';
    }

    public function setup(NameResolver $fqn): void
    {
        $name = Str::snake($fqn->getClassName());

        [$table, $create] = TableGuesser::guess($name);

        if (is_null($table)) {
            $this->stub = 'migration.stub';
        } elseif ($create) {
            $this->stub = 'migration.create.stub';
        } else {
            $this->stub = 'migration.update.stub';
        }

        $this->mergePlaceholders([
            '{{ table }}' => $table,
        ]);
    }
}
