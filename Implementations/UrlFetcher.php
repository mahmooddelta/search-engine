<?php

namespace App\Implementations;


use App\Interfaces\UrlFetcherInterface;

class UrlFetcher implements UrlFetcherInterface
{
    public function fetch(string $url): string
    {
        return @file_get_contents($url);
    }
}
