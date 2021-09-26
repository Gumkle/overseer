<?php

namespace App\Infrastructure\Config\Selectors;

class HuaweiSelectorsConfig
{
    public function __construct(
        private string $loginInput,
        private string $passwordInput,
        private string $loginSubmitButton,
        private string $restResponse
    ) {}

    public function loginInput(): string
    {
        return $this->loginInput;
    }

    public function passwordInput(): string
    {
        return $this->passwordInput;
    }

    public function loginSubmitButton(): string
    {
        return $this->loginSubmitButton;
    }

    public function restResponse()
    {
        return $this->restResponse;
    }
}
