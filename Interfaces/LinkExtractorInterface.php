<?php

namespace App\Interfaces;

interface LinkExtractorInterface
{
    public function extract(string $html, string $baseUrl): array;
}
