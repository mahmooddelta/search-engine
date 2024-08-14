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


$urls = [
    "http://localhost/crawel/test",
//    "http://mortezaaminitabar.com",
//    "https://example.com",
//    "https://blog.ir/",
//    "https://asemooni.com/",
];


foreach ($urls as $url) {
    echo "Processing URL: $url\n";

    /*
     *  ------------------------- Crawler ---------------------------------
     */
    $crawler = new Crawler($url, $urlFetcher, $linkExtractor, $urlNormalizer);
    $pages = $crawler->crawl();

    echo "Crawled Pages:\n";
    print_r($pages);

    /*
     *  ------------------------- WordProcessor ---------------------------------
     */
    $wordProcessor = new WordProcessor($pages, $wordNormalizer);
    $normalizeWords = $wordProcessor->getNormalizeWords();

    echo "Normalize Words:\n";
    print_r($normalizeWords);

    $uniqueWords = $wordProcessor->getUniqueWords();
    $extractUniqueWords = $wordProcessor->extractUniqueWords();

    echo "Unique Words:\n";
    print_r($uniqueWords);

    /*
     *  ------------------------- SearchEngine ---------------------------------
     */
    $searchEngine = new SearchEngine('mahmood', $extractUniqueWords, $wordNormalizer);
    $searchWord = $searchEngine->search();

    echo "Search Results for 'SearchTerm':\n";
    print_r($searchWord);

    /*
     *  ------------------------- SuggestionEngine ---------------------------------
     */
    $suggestionEngine = new SuggestionEngine('mahmoud', $extractUniqueWords, $levenshtein);
    $suggestionWord = $suggestionEngine->suggest();

    echo "Suggestions for 'mahmoud':\n";
    print_r($suggestionWord);

    /*
     *  ------------------------- DownloadFile ---------------------------------
     */
    $downloadFile = new DownloadFile($pages);
    $files = $downloadFile->downloadFiles();

    echo "Downloaded Files:\n";
    print_r($files);

    echo "\n---------------------------------\n\n";
}




///*
// *  ------------------------- Crawler ---------------------------------
// */
//$crawler = new Crawler($urls[0], $urlFetcher, $linkExtractor, $urlNormalizer);
//$pages = $crawler->crawl();
//
//echo '<pre>';
//print_r($pages);
//echo '</pre>';
///*
// *  ------------------------- WordProcessor ---------------------------------
// */
//
//$wordProcessor = new WordProcessor($pages, $wordNormalizer);
//$normalizeWords = $wordProcessor->getNormalizeWords();
//$uniqueWords = $wordProcessor->getUniqueWords();
//$extractUniqueWords = $wordProcessor->extractUniqueWords();
//
//echo '<pre>';
//print_r($uniqueWords);
//echo '</pre>';
///*
// *  ------------------------- SearchEngine ---------------------------------
// */
//
//$searchEngine = new SearchEngine('Mahmood', $extractUniqueWords, $wordNormalizer);
//$searchWord = $searchEngine->search();
//
//echo '<pre>';
//print_r($searchWord);
//echo '</pre>';
///*
// *  ------------------------- SuggestionEngine ---------------------------------
// */
//
//$suggestionEngine = new SuggestionEngine('Mahmoud', $extractUniqueWords, $levenshtein);
//$suggestionWord = $suggestionEngine->suggest();
//
//echo '<pre>';
//print_r($suggestionWord);
//echo '</pre>';
//
///*
// *  ------------------------- DownloadFile ---------------------------------
// */
//
//$downloadFile = new DownloadFile($pages);
//$files = $downloadFile->downloadFiles();
//
//echo '<pre>';
//print_r($files);
//echo '</pre>';