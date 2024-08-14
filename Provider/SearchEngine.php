<?php

namespace App\Provider;

use App\Interfaces\NormalizerInterface;

class SearchEngine
{
    public function __construct(
        public string              $word,
        public array               $uniqueWords,
        public NormalizerInterface $wordNormalizer)
    {
    }

    public function search(): array
    {
        $normalizedWord = $this->wordNormalizer->normalize($this->word);
        return $this->uniqueWords[$normalizedWord] ?? [];
    }

}

