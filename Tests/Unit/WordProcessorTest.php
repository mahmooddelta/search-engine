<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Provider\WordProcessor;
use App\Interfaces\NormalizerInterface;

class WordProcessorTest extends TestCase
{
    public function testExtractUniqueWords()
    {
        $mockNormalizer = $this->createMock(NormalizerInterface::class);
        $mockNormalizer->method('normalize')
            ->willReturnCallback(function ($word) {
                return strtolower($word);
            });

        $pages = [
            ['url' => 'http://example.com', 'content' => '<p>Test Word</p>'],
            ['url' => 'http://example.com/about', 'content' => '<p>Another Word</p>'],
        ];

        $wordProcessor = new WordProcessor($pages, $mockNormalizer);
        $uniqueWords = $wordProcessor->extractUniqueWords();

        $this->assertArrayHasKey('test', $uniqueWords);
        $this->assertArrayHasKey('another', $uniqueWords);
    }
}
