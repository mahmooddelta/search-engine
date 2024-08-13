<?php
require 'vendor/autoload.php';



use App\Src\Crawler;
use App\Src\LinkExtractor;
use App\Src\UrlFetcher;
use App\Src\WordProcessor;
use App\Src\SuggestionEngine;
use App\Src\SearchEngine;
use App\Src\DownloadFile;
use App\Interfaces\LinkExtractorInterface;
use App\Interfaces\UrlFetcherInterface;


$urlFetcher = new UrlFetcher();
$linkExtractor = new LinkExtractor();
$crawler = new Crawler("http://localhost/crawel/test", $urlFetcher, $linkExtractor);
$pages = $crawler->crawl();

$wordProcessor = new WordProcessor($pages);
print_r($wordProcessor->getUniqueWords());


//$crawler = new Crawler("http://test.ir/");
//print_r($crawler->crawl());
//$wordProcessor = new WordProcessor($crawler->crawl());
//$wordProcessor->getUniqueWords();

//$searchEngine = new SearchEngine('design', $wordProcessor->extractUniqueWords());
//print_r($searchEngine->search());
//$suggestionEngine = new SuggestionEngine('bar2mblogir', $wordProcessor->extractUniqueWords());

//$downloadFiles = new DownloadFile($crawler->crawl());
//print_r($downloadFiles->downloadFiles());
