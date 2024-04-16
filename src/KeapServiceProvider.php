<?php

namespace Azzarip\Keap;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Azzarip\Keap\Commands\KeapCommand;

class KeapServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-keap')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-keap_table')
            ->hasCommand(KeapCommand::class);
    }
}
