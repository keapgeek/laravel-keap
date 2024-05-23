<?php

namespace KeapGeek\Keap;

use KeapGeek\Keap\Commands\RefreshToken;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile('keap')
            ->hasRoute('routes')
            ->hasMigration('create_laravel-keap_table')
            ->hasCommand(RefreshToken::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('keapgeek/laravel-keap');
            });
    }
}
