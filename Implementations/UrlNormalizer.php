<?php
namespace App\Implementations;


use App\Interfaces\NormalizerInterface;

class UrlNormalizer implements NormalizerInterface
{
    public function normalize(string $url): string
    {
        $url = preg_replace('/^https?:\/\//', 'http://', $url);
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['path']) && preg_match('/\/index\.html$/', $parsedUrl['path'])) {
            $url = str_replace('/index.html', '/', $url);
        }

        return rtrim($url, '/');
    }
}
