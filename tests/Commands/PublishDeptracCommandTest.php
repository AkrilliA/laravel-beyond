<?php

namespace Tests\Commands;

use Tests\TestCase;

class PublishDeptracCommandTest extends TestCase
{
    public function testCanPublishDeptrac(): void
    {
        $this->artisan('beyond:publish:deptrac');

        $this->assertFileExists(base_path('deptrac.yaml'));
    }

    public function testCanPublishDeptracUsingForce(): void
    {
        $this->artisan('beyond:publish:deptrac --force');

        $this->assertFileExists(base_path('deptrac.yaml'));
    }
}
