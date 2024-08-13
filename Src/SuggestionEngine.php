<?php

namespace App\src;

class SuggestionEngine
{
    private $word;
    private $uniqueWords;

    public function __construct($word, $uniqueWords)
    {
        $this->word = $word;
        $this->uniqueWords = $uniqueWords;
    }
    public function suggest(): array
    {
        $suggestions = [];
        foreach (array_keys($this->uniqueWords) as $this->uniqueWord) {
            $distance = $this->levenshteinDistance($this->word, $this->uniqueWord);
            if ($distance <= 2) {
                $suggestions[$this->uniqueWord] = $distance;
            }
        }
        asort($suggestions);
        return $suggestions;
    }

    private function levenshteinDistance($str1, $str2) {
        $len1 = strlen($str1);
        $len2 = strlen($str2);

        // ایجاد ماتریس فاصله
        $matrix = array();
        for ($i = 0; $i <= $len1; $i++) {
            $matrix[$i] = array();
            $matrix[$i][0] = $i;
        }
        for ($j = 0; $j <= $len2; $j++) {
            $matrix[0][$j] = $j;
        }

        // پر کردن ماتریس
        for ($i = 1; $i <= $len1; $i++) {
            for ($j = 1; $j <= $len2; $j++) {
                // استفاده از توابع برای اطمینان از وجود مقادیر
                @$char1 = ($i - 1 < $len1) ? $str1[$i - 1] : '';
                @$char2 = ($j - 1 < $len2) ? $str2[$j - 1] : '';
                $cost = ($char1 === $char2) ? 0 : 1;
                $matrix[$i][$j] = min(
                    $matrix[$i - 1][$j] + 1, // حذف
                    $matrix[$i][$j - 1] + 1, // درج
                    $matrix[$i - 1][$j - 1] + $cost // جایگزینی
                );
            }
        }

        // مقدار نهایی فاصله
        return $matrix[$len1][$len2];
    }
}

