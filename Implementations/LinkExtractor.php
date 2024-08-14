<?php

namespace App\Implementations;

use App\Interfaces\LinkExtractorInterface;

class LinkExtractor implements LinkExtractorInterface
{
    public function extract(string $html, string $baseUrl): array
    {
        preg_match_all('/<a\s+(?:[^>]*?\s+)?href="(?!#)((?!mailto:)(?!.*\.(jpg|jpeg|png|gif|bmp|pdf|doc|docx|xls|xlsx|zip|rar|mp4|mp3|avi|mov|wmv|exe))[^"]*)"/', $html, $matches);
        $links = [];
        foreach ($matches[1] as $link) {
            $nextUrl = filter_var($link, FILTER_VALIDATE_URL) ? $link : rtrim($baseUrl, '/') . '/' . ltrim($link, '/');
            $links[] = $nextUrl;
        }
        return $links;
    }
}
