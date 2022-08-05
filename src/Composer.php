<?php

namespace Regnerisch\LaravelBeyond;

final class Composer
{
    protected static ?self $instance = null;

    protected array $packages;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct() {}

    public function isPackageInstalled(string $name): bool
    {
        $packages = $this->packages ?? $this->packages = $this->getPackages();

        return in_array($name, $packages, true);
    }

    protected function getPackages(): array
    {
        $packages = shell_exec('cd ' . base_path() . ' && composer show --name-only');
        $packages = explode(PHP_EOL, $packages);
        $packages = array_map(fn ($package) => trim($package), $packages);

        return array_filter($packages);
    }
}