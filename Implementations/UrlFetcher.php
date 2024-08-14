<?php
namespace App\Implementations;


use App\Interfaces\UrlFetcherInterface;

class UrlFetcher implements UrlFetcherInterface
{
    public function fetch(string $url): string
    {
        $html = @file_get_contents($url);
//        if ($html === false) {
//            $error = error_get_last();
//            throw new \Exception("Error fetching the URL: " . $error['message']);
//        }
        return $html;
    }
}
