<?php

namespace App\Infrastructure\Providers;

use App\Infrastructure\Cryptography\LaravelPasswordEncrypter;
use App\Infrastructure\Cryptography\PasswordEncrypter;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PasswordEncrypterProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        PasswordEncrypter::class => LaravelPasswordEncrypter::class
    ];

    public function provides()
    {
        return [
            PasswordEncrypter::class
        ];
    }
}
