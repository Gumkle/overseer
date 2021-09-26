<?php

namespace App\Infrastructure\Cryptography;

use Illuminate\Encryption\Encrypter;

class LaravelPasswordEncrypter implements PasswordEncrypter
{
    public function __construct(
        private Encrypter $encrypter
    ) {}

    public function encrypt(string $payload): string
    {
        return $this->encrypter->encrypt($payload);
    }

    public function decrypt(string $payload): string
    {
        return $this->encrypter->decrypt($payload);
    }
}
