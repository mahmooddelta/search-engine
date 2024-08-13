<?php

namespace App\Provider;

class SearchEngine
{
    private $word;
    private $uniqueWords;

    public function __construct($word, $uniqueWords)
    {
        $this->word = $word;
        $this->uniqueWords = $uniqueWords;
    }

    public function search(): array
    {
        $normalizedWord = $this->normalizeWord($this->word);
        return isset($this->uniqueWords[$normalizedWord]) ? $this->uniqueWords[$normalizedWord] : [];
    }
    private function normalizeWord($word) {
        $word = strtolower($word);
        return preg_replace('/[^\p{L}\p{N}\s]+/u', '', $word);
    }

}

