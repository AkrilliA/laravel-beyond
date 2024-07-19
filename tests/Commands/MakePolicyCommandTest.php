<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakePolicyCommandTest extends TestCase
{
    public function testCanMakePolicy(): void
    {
        $this->artisan('beyond:make:policy User.UserPolicy');

        $file = beyond_domain_path('User/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Domain\\User\\Policies', $contents);
        $this->assertClassName('UserPolicy', $contents);
    }

    public function testCanMakePolicyUsingForce(): void
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

    public function testCanMakeAppPolicyIfGatePublished(): void
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
