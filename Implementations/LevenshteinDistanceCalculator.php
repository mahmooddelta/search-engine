<?php
namespace App\Implementations;


use App\Interfaces\DistanceCalculatorInterface;

class LevenshteinDistanceCalculator implements DistanceCalculatorInterface
{
    public function calculate($str1, $str2): int
    {
        $len1 = strlen($str1);
        $len2 = strlen($str2);

        $matrix = array();
        for ($i = 0; $i <= $len1; $i++) {
            $matrix[$i] = array();
            $matrix[$i][0] = $i;
        }
        for ($j = 0; $j <= $len2; $j++) {
            $matrix[0][$j] = $j;
        }

        for ($i = 1; $i <= $len1; $i++) {
            for ($j = 1; $j <= $len2; $j++) {
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

        return $matrix[$len1][$len2];
    }
}
