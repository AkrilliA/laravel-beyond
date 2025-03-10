<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakePolicyCommandTest extends TestCase
{
    public function test_can_make_policy(): void
    {
        $this->artisan('beyond:make:policy User.UserPolicy');

        $file = beyond_domain_path('User/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Domain\\User\\Policies', $contents);
        $this->assertClassName('UserPolicy', $contents);
    }

    public function test_can_make_policy_using_force(): void
    {
        $this->artisan('beyond:make:policy User.UserPolicy');

        $file = beyond_domain_path('User/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Domain\\User\\Policies', $contents);
        $this->assertClassName('UserPolicy', $contents);

        $code = $this->artisan('beyond:make:policy User.UserPolicy --force');

        $code->assertOk();
    }

    public function test_can_make_app_policy_if_gate_published(): void
    {
        $this->artisan('beyond:publish:gate');
        $this->artisan('beyond:make:policy User.UserPolicy');

        $file = beyond_app_path('User/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Application\\User\\Policies', $contents);
        $this->assertClassName('UserPolicy', $contents);
    }
}
