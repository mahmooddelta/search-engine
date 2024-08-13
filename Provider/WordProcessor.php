<?php

namespace App\Provider;

class WordProcessor
{

    private $pages;
    public function __construct($pages)
    {
        $this->pages = $pages;
    }
    public function extractUniqueWords(): array
    {
        $uniqueWords = [];

        foreach ($this->pages as $page) {
            $words = preg_split('/\s+/', strip_tags($page['content']));
            $words = array_filter($words);
            foreach ($words as $word) {
                $normalizedWord = $this->normalizeWordSame($word);
                if ($normalizedWord) {
                    if (!isset($uniqueWords[$normalizedWord])) {
                        $uniqueWords[$normalizedWord] = [];
                    }
                    if (!in_array($page['url'], $uniqueWords[$normalizedWord])) {
                        $uniqueWords[$normalizedWord][] = $page['url'];
                    }
                }
            }
        }

        return $uniqueWords;
    }
    public function getUniqueWords() {
        $result = [];

        foreach ($this->pages as $page) {
            $words = preg_split('/\s+/', strip_tags($page['content']));
            $words_empty = array_filter($words);
            $processedWords = $this->normalizeWords($words_empty);
//            $processedWords = array_map('normalizeWord', $words_empty);
            $uniqueWords = array_unique($processedWords);

            $result[]['url'] = $page['url'];
            $result[]['contents'] = $uniqueWords;
        }

        return $result;
    }


    public function getNormalizeWords(): array
    {
        $result = [];

        foreach ($this->pages as $page) {
            $words = preg_split('/\s+/', strip_tags($page['content']));
            $words_empty = array_filter($words);
            $processedWords = $this->normalizeWords($words_empty);

            $result[]['url'] = $page['url'];
            $result[]['contents'] = $processedWords;
        }

        return $result;
    }

    private function normalizeWords(array $words): array
    {
        return array_map(function($word) {
            $word = strtolower(trim($word));
            return preg_replace('/[^\p{L}\p{N}\s]+/u', '', $word);
        }, $words);
    }

    public function normalizeWordSame($word) {
        $word = strtolower($word);
//    return preg_replace('/\W+/', '', $word);  // حذف علائم نگارشی
        return preg_replace('/[^\p{L}\p{N}\s]+/u', '', $word);
    }
}

