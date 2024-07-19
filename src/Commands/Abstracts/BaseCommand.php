<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

use AkrilliA\LaravelBeyond\Affiliation;
use AkrilliA\LaravelBeyond\NameResolver;
use AkrilliA\LaravelBeyond\Type;
use Illuminate\Console\Command;
use Illuminate\Support\Stringable;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;

abstract class BaseCommand extends Command
{
    /** @var array<string, string> */
    private array $placeholders = [];

    /** @var array<callable> */
    private array $onSuccess = [];

    /** @var array<string> */
    protected $aliases = [];

    abstract protected function getStub(): string;

    abstract public function getAffiliation(): Affiliation;

    abstract public function getType(): Type;

    public function getNamespaceTemplate(): string
    {
        return $this->getAffiliation()->toNamespaceTemplate();
    }

    public function getFileNameTemplate(): string
    {
        return '%s.php';
    }

    protected function addOnSuccess(callable $callback): void
    {
        $this->onSuccess[] = $callback;
    }

    /**
     * @param  array<string, string>  $array
     */
    protected function mergePlaceholders(array $array): void
    {
        $this->placeholders = array_merge(
            $this->placeholders,
            $array
        );
    }

    protected function getNameArgument(): string
    {
        return trim($this->argument('name'));
    }

    public function getNameResolver(?string $name = null): NameResolver
    {
        return new NameResolver($this, new Stringable($name ?: $this->getNameArgument()));
    }

    protected function configure(): void
    {
        $this->setAliases($this->aliases);

        parent::configure();
    }

    public function handle(): void
    {
        try {
            $fqn = $this->getNameResolver();

            if (method_exists($this, 'setup')) {
                $this->setup($fqn);
            }

            $refactor = array_merge(
                [
                    '{{ namespace }}' => $fqn->getNamespace(),
                    '{{ className }}' => $fqn->getClassName(),
                ],
                $this->placeholders
            );

            beyond_copy_stub(
                $this->getStub(),
                beyond_path($fqn->getPath()),
                $refactor,
                $this->hasOption('force') ? (bool) $this->option('force') : false
            );

            info($this->getType()->getName()." [{$fqn->getPath()}] created successfully.");

            foreach ($this->onSuccess as $callback) {
                $callback($fqn->getNamespace(), $fqn->getClassName());
            }
        } catch (\Exception $exception) {
            error($exception->getMessage());
        }
    }
}
