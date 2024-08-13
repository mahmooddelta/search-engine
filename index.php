<?php
require 'vendor/autoload.php';


use App\Provider\Crawler;
use App\Provider\LinkExtractor;
use App\Provider\UrlFetcher;
use App\Provider\WordProcessor;
use App\Provider\SuggestionEngine;
use App\Provider\SearchEngine;
use App\Provider\DownloadFile;



$urlFetcher = new UrlFetcher();
$linkExtractor = new LinkExtractor();

$crawler = new Crawler("http://localhost/crawel/test", $urlFetcher, $linkExtractor);
$pages = $crawler->crawl();

$wordProcessor = new WordProcessor($pages);
$normalizeWords = $wordProcessor->getNormalizeWords();
$uniqueWords = $wordProcessor->getUniqueWords();
$extractUniqueWords = $wordProcessor->extractUniqueWords();

$searchEngine = new SearchEngine('Mahmood', $extractUniqueWords);
$searchWord = $searchEngine->search();

$suggestionEngine = new SuggestionEngine('Mahmoud', $extractUniqueWords);
$suggestionWord = $suggestionEngine->suggest();

$downloadFile = new DownloadFile($pages);
print_r($downloadFile->downloadFiles());