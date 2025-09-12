<?php

namespace Taecontrol\OpenRouter;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Taecontrol\OpenRouter\Commands\OpenRouterCommand;

class OpenRouterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('openrouter-laravel-sdk')
            ->hasConfigFile();
    }
}
