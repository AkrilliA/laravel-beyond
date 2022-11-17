<?php

namespace AkrilliA\LaravelBeyond\Console;

use Illuminate\Console\Command as LaravelCommand;
use AkrilliA\LaravelBeyond\Exceptions\AbortCommandException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends LaravelCommand
{
    protected array $handlers = [];

    protected function addAdditionalHandler(callable $callable): void
    {
        $this->handlers[] = $callable;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            if (method_exists($this, 'before')) {
                $this->before();
            }

            $method = method_exists($this, 'handle') ? 'handle' : '__invoke';

            $code = (int) $this->laravel->call([$this, $method]);

            foreach ($this->handlers as $callable) {
                $callable($code);
            }

            if (method_exists($this, 'after')) {
                $this->after($code);
            }

            return $code;
        } catch (AbortCommandException $exception) {
            if (!empty($exception->getMessage())) {
                $this->components->error($exception->getMessage());
            }

            return $exception->getCode();
        }
    }
}
