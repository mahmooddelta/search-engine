<?php

namespace App\Provider;

use App\Interfaces\NormalizerInterface;

class WordProcessor
{
    public function __construct(
        public array               $pages,
        public NormalizerInterface $normalizer)
    {
    }

    public function extractUniqueWords(): array
    {
        $uniqueWords = [];

        foreach ($this->pages as $page) {
            $words = preg_split('/\s+/', strip_tags($page['content']));
            $words = array_filter($words);
            foreach ($words as $word) {
                $normalizedWord = $this->normalizer->normalize($word);
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

    public function getUniqueWords(): array
    {
        $result = [];

        foreach ($this->pages as $page) {
            $words = preg_split('/\s+/', strip_tags($page['content']));
            $words_empty = array_filter($words);
            $processedWords = $this->normalizeWords($words_empty);
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
        return array_map([$this->normalizer, 'normalize'], $words);
    }

}

