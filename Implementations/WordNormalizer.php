<?php
namespace App\Implementations;


use App\Interfaces\NormalizerInterface;

class WordNormalizer implements NormalizerInterface
{
    public function normalize(string $word): string
    {
        $word = strtolower(trim($word));
        return preg_replace('/[^\p{L}\p{N}\s]+/u', '', $word);
    }
}
