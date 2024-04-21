<?php

namespace Azzarip\Keap\Tests;

use Azzarip\Keap\KeapServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Cache;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Azzarip\\Keap\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Cache::put('keap.access_token', '::access_token::', '3600');
        Cache::put('keap.refresh_token', '::refresh_token::', '3600');

    }

    protected function getPackageProviders($app)
    {
        return [
            KeapServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-keap_table.php.stub';
        $migration->up();
        */
    }
}
