<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeCastCommandTest extends TestCase
{
    public function testCanMakeCast(): void
    {
        $this->artisan('beyond:make:cast TimezoneCast');

        $file = beyond_support_path('Casts/TimezoneCast.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Support\\Casts', $contents);
        $this->assertClassName('TimezoneCast', $contents);
    }

    public function testCanMakeCastUsingForce(): void
    {
        $this->artisan('beyond:make:cast TimezoneCast');

        $file = beyond_support_path('Casts/TimezoneCast.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Support\\Casts', $contents);
        $this->assertClassName('TimezoneCast', $contents);

        $code = $this->artisan('beyond:make:cast TimezoneCast --force');

        $code->assertOk();
    }
}
