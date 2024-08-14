<?php

namespace App\Provider;

use App\Interfaces\LinkExtractorInterface;
use App\Interfaces\NormalizerInterface;
use App\Interfaces\UrlFetcherInterface;


class Crawler
{
    private array $pages = [];

    public function __construct(
        private readonly string                 $baseUrl,
        private readonly UrlFetcherInterface    $urlFetcher,
        private readonly LinkExtractorInterface $linkExtractor,
        private readonly NormalizerInterface    $urlNormalizer,
        public int                              $maxDepth = 1
    )
    {
    }

    public function crawl(): array
    {
        $visited = [];

        $this->crawlPage($this->baseUrl, 0, $visited);

        return $this->pages;
    }

    private function crawlPage(string $url, int $depth, array &$visited): void
    {
        $normalizedUrl = $this->urlNormalizer->normalize($url);

        if ($depth > $this->maxDepth || in_array($normalizedUrl, $visited)) {
            return;
        }

        $visited[] = $normalizedUrl;

        $html = $this->urlFetcher->fetch($normalizedUrl);

        if ($html) {

            $this->pages[] = ['url' => $normalizedUrl, 'content' => $html];

            $links = $this->linkExtractor->extract($html, $this->baseUrl);

            foreach ($links as $link) {

                if ($this->isSameHost($link, $this->baseUrl)) {
                    $this->crawlPage($link, $depth + 1, $visited);
                }
            }
        }
    }

    private function isSameHost(string $url1, string $url2): bool
    {
        return parse_url($url1, PHP_URL_HOST) === parse_url($url2, PHP_URL_HOST);
    }
}