<?php

// tests/Integration/CrawlerIntegrationTest.php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use App\Provider\Crawler;
use App\Implementations\UrlFetcher;
use App\Implementations\LinkExtractor;
use App\Implementations\UrlNormalizer;

class CrawlerIntegrationTest extends TestCase
{
    public function testCrawl()
    {
        $urlFetcher = new UrlFetcher();
        $linkExtractor = new LinkExtractor();
        $urlNormalizer = new UrlNormalizer();

        $crawler = new Crawler('http://example.com', $urlFetcher, $linkExtractor, $urlNormalizer, 1);
        $pages = $crawler->crawl();

        $this->assertNotEmpty($pages);
        $this->assertEquals('http://example.com', $pages[0]['url']);
    }
}
