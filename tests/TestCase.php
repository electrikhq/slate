<?php

namespace Electrik\Slate\Tests;

use BladeUI\Icons\BladeIconsServiceProvider;
use Electrik\Slate\SlateServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            SlateServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        
        // Setup Blade Icons if available
        if (class_exists(\BladeUI\Icons\BladeIconsServiceProvider::class)) {
            $app->register(\BladeUI\Icons\BladeIconsServiceProvider::class);
        }
    }
}

