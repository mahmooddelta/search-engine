<?php
require 'vendor/autoload.php';


use App\Src\Crawler;
use App\Src\LinkExtractor;
use App\Src\UrlFetcher;
use App\Src\WordProcessor;
use App\Src\SuggestionEngine;
use App\Src\SearchEngine;
use App\Src\DownloadFile;



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