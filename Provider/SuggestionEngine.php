<?php

namespace App\Provider;

use App\Interfaces\DistanceCalculatorInterface;

class SuggestionEngine
{
    public function __construct(
        public string                      $word,
        public array                       $uniqueWords,
        public DistanceCalculatorInterface $distanceCalculator
    )
    {
    }

    public function suggest(): array
    {
        $suggestions = [];
        foreach (array_keys($this->uniqueWords) as $this->uniqueWord) {
            $distance = $this->distanceCalculator->calculate($this->word, $this->uniqueWord);
            if ($distance <= 2) {
                $suggestions[$this->uniqueWord] = $distance;
            }
        }
        asort($suggestions);
        return $suggestions;
    }

}

