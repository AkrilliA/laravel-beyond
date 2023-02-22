<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    protected array $requiredPackages = [];

    public ?int $minimumVersionId = null;

    protected function before(): int
    {
        if ($code = $this->checkVersionId()) {
            return $code;
        }

        if ($code = $this->checkDependencies()) {
            return $code;
        }

        return 0;
    }

    protected function checkDependencies(): int
    {
        if ([] === $missingPackages = $this->getMissingPackages()) {
            return 0;
        }

        $this->components->error(
            sprintf(
                'There are missing packages. Run composer require %s to install them.',
                implode(' ', $missingPackages)
            )
        );

        foreach ($missingPackages as $missingPackage) {
            $this->components->twoColumnDetail($missingPackage, 'MISSING');
        }

        return 1;
    }

    protected function checkVersionId(): int
    {
        if (! $this->minimumVersionId) {
            return 0;
        }

        if (PHP_VERSION_ID < $this->minimumVersionId) {
            $this->components->error(
                sprintf(
                    'Your version id %s does not match the required version id %s of this command.',
                    PHP_VERSION_ID,
                    $this->minimumVersionId
                )
            );

            return 1;
        }

        return 0;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this instanceof Isolatable && $this->option('isolated') !== false &&
            ! $this->commandIsolationMutex()->create($this)) {
            $this->comment(sprintf(
                'The [%s] command is already running.', $this->getName()
            ));

            return (int) (is_numeric($this->option('isolated'))
                ? $this->option('isolated')
                : self::SUCCESS);
        }

        $code = null;

        if (method_exists($this, 'before')) {
            $code = $this->before();

            if ($code) {
                return (int) $code;
            }
        }

        $method = method_exists($this, 'handle') ? 'handle' : '__invoke';

        try {
            $originalCode = (int) $this->laravel->call([$this, $method]);

            if (method_exists($this, 'after')) {
                $code = $this->after($originalCode);
            }

            return is_null($code) ? $originalCode : (int) $code;
        } finally {
            if ($this instanceof Isolatable && $this->option('isolated') !== false) {
                $this->commandIsolationMutex()->forget($this);
            }
        }
    }

    protected function getMissingPackages(): array
    {
        $composer = $this->getLaravel()->get(ComposerContract::class);

        return array_diff($this->requiredPackages, $composer->getPackages()['require']);
    }
}
