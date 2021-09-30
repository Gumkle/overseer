<?php

namespace App\Infrastructure\Downloaders;

class DataSourceResponse
{
    public function __construct(
        private array $rawResponse
    )
    {
    }

    public function arrayFromPath(string $path): array
    {
        $fragmentedPath = explode('.', $path);
        $result = $this->rawResponse;
        foreach ($fragmentedPath as $key) {
            $result = $result[$key];
        }
        return $result;
    }
}
