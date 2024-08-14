<?php

namespace App\Provider;

use App\Interfaces\NormalizerInterface;

class SearchEngine
{
    private string $word;
    private $uniqueWords;
    private NormalizerInterface $wordNormalizer;

    public function __construct($word, $uniqueWords, NormalizerInterface $wordNormalizer)
    {
        $this->word = $word;
        $this->uniqueWords = $uniqueWords;
        $this->wordNormalizer = $wordNormalizer;
    }

    public function search(): array
    {
//        $normalizedWord = $this->normalizeWord($this->word);
        $normalizedWord = $this->wordNormalizer->normalize($this->word);
        return isset($this->uniqueWords[$normalizedWord]) ? $this->uniqueWords[$normalizedWord] : [];
    }
    private function normalizeWord($word) {
        $word = strtolower($word);
        return preg_replace('/[^\p{L}\p{N}\s]+/u', '', $word);
    }

}

