<?php

namespace App\Interfaces;

interface UrlFetcherInterface
{
    public function fetch(string $url): string;
}
