<?php
require 'vendor/autoload.php';


require './Src/Crawler.php';
require './Src/SearchEngine.php';
require './Src/SuggestionEngine.php';
require './Src/WordProcessor.php';
require './Src/DownloadFile.php';
require './Src/UrlFetcher.php';
require './Src/LinkExtractor.php';

use App\Src\Crawler;
use App\Src\LinkExtractor;
use App\Src\UrlFetcher;
use App\Src\WordProcessor;
use App\Src\SuggestionEngine;
use App\Src\SearchEngine;
use App\Src\DownloadFile;
use App\Interfaces\LinkExtractorInterface;
use App\Interfaces\UrlFetcherInterface;

// ساختن شیء از کلاس UrlFetcher
$urlFetcher = new UrlFetcher();

// ساختن شیء از کلاس LinkExtractor
$linkExtractor = new LinkExtractor();

// ساختن شیء از کلاس Crawler و پاس دادن ورودی‌ها
$crawler = new Crawler("http://mortezaaminitabar.com", $urlFetcher, $linkExtractor);
print_r($crawler->crawl());


//$crawler = new Crawler("http://test.ir/");
//print_r($crawler->crawl());
//$wordProcessor = new WordProcessor($crawler->crawl());
//$wordProcessor->getUniqueWords();

//$searchEngine = new SearchEngine('design', $wordProcessor->extractUniqueWords());
//print_r($searchEngine->search());
//$suggestionEngine = new SuggestionEngine('bar2mblogir', $wordProcessor->extractUniqueWords());

//$downloadFiles = new DownloadFile($crawler->crawl());
//print_r($downloadFiles->downloadFiles());
