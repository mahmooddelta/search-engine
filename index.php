<?php
require 'vendor/autoload.php';


use App\Implementations\LevenshteinDistanceCalculator;
use App\Implementations\LinkExtractor;
use App\Implementations\UrlFetcher;
use App\Implementations\UrlNormalizer;
use App\Implementations\WordNormalizer;
use App\Provider\Crawler;
use App\Provider\DownloadFile;
use App\Provider\SearchEngine;
use App\Provider\SuggestionEngine;
use App\Provider\WordProcessor;


$urlFetcher = new UrlFetcher();
$linkExtractor = new LinkExtractor();
$urlNormalizer = new UrlNormalizer();
$wordNormalizer = new WordNormalizer();
$levenshtein = new LevenshteinDistanceCalculator();

$url = "http://localhost/crawel/test";
//$url = 'https://blog.ir/';
//$url = 'http://mortezaaminitabar.com';
//$url = 'https://www.w3schools.com/';
//$url = 'https://asemooni.com/';


$crawler = new Crawler($url, $urlFetcher, $linkExtractor, $urlNormalizer);
$pages = $crawler->crawl();
$wordProcessor = new WordProcessor($pages, $wordNormalizer);
$normalizeWords = $wordProcessor->getNormalizeWords();
$uniqueWords = $wordProcessor->getUniqueWords();
$extractUniqueWords = $wordProcessor->extractUniqueWords();
$searchEngine = new SearchEngine('Apple', $extractUniqueWords, $wordNormalizer);
$searchWord = $searchEngine->search();

$suggestionEngine = new SuggestionEngine('bamana', $extractUniqueWords, $levenshtein);
$suggestionWord = $suggestionEngine->suggest();

echo '<pre>';
print_r($suggestionWord);
echo '</pre>';

$downloadFile = new DownloadFile($pages);

//echo '<pre>';
//print_r($downloadFile->downloadFiles());
//echo '</pre>';
