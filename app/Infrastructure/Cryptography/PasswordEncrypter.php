<?php

namespace App\Infrastructure\Cryptography;

interface PasswordEncrypter
{
    public function encrypt(string $payload): string;
    public function decrypt(string $payload): string;
}
