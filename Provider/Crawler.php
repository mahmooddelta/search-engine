<?php

namespace App\Provider;

use App\Interfaces\LinkExtractorInterface;
use App\Interfaces\NormalizerInterface;
use App\Interfaces\UrlFetcherInterface;


class Crawler
{
    private array $pages = [];

    public function __construct(
        private string                 $baseUrl,
        private UrlFetcherInterface    $urlFetcher,
        private LinkExtractorInterface $linkExtractor,
        private NormalizerInterface    $urlNormalizer,
        public int                     $maxDepth = 1
    )
    {
    }

    public function crawl(): array
    {
        $visited = [];

        $this->crawlPage($this->baseUrl, 0, $visited);

        return $this->pages;
    }

    private function crawlPage(string $url, int $depth, array &$visited)
    {
//        $normalizedUrl = $this->normalizeUrl($url);
        $normalizedUrl = $this->urlNormalizer->normalize($url);

        if ($depth > $this->maxDepth || in_array($normalizedUrl, $visited)) {
            return;
        }

        $visited[] = $normalizedUrl;
//        var_dump($visited);
//        try {
        $html = $this->urlFetcher->fetch($normalizedUrl);
        if ($html !== false) {
            $this->pages[] = ['url' => $normalizedUrl, 'content' => $html];
//            preg_match_all('/<a\s+(?:[^>]*?\s+)?href="(?!#)((?!mailto:)(?!.*\.(jpg|jpeg|png|gif|bmp|pdf|doc|docx|xls|xlsx|zip|rar|mp4|mp3|avi|mov|wmv|exe))[^"]*)"/', $html, $matches);

            $links = $this->linkExtractor->extract($html, $this->baseUrl);
//            echo '<pre>';
//            print_r($links);
//            echo '</pre>';
            foreach ($links as $link) {
//                $nextUrl = filter_var($link, FILTER_VALIDATE_URL) ? $link : rtrim($this->baseUrl, '/') . '/' . ltrim($link, '/');
                if (parse_url($link, PHP_URL_HOST) === parse_url($this->baseUrl, PHP_URL_HOST)) {
                    $this->crawlPage($link, $depth + 1, $visited);
                }
            }
        }

//            $error = error_get_last();
//            throw new \Exception("Fetching the URL: " . $url);
//        } catch (\Exception $e) {
//            error_log('Error: ' . $e->getMessage());
////            return 'Error: ' . $e->getMessage();
//        }
    }


    private function normalizeUrl(string $url): string
    {
        $url = preg_replace('/^https?:\/\//', 'http://', $url);
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['path']) && preg_match('/\/index\.html$/', $parsedUrl['path'])) {
            $url = str_replace('/index.html', '/', $url);
        }

        return rtrim($url, '/');
    }
}