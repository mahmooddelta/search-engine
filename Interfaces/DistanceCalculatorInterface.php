<?php

namespace App\Interfaces;

interface DistanceCalculatorInterface
{
    public function calculate(string $str1, string $str2): int;
}
