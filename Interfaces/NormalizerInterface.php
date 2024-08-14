<?php

namespace App\Interfaces;

interface NormalizerInterface
{
    public function normalize(string $str): string;
}
