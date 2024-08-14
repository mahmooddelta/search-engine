<?php

use PHPUnit\Framework\TestCase;
use App\Implementations\LevenshteinDistanceCalculator;

class LevenshteinDistanceCalculatorTest extends TestCase
{
    private LevenshteinDistanceCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new LevenshteinDistanceCalculator();
    }

    public function testCalculateSameStrings(): void
    {
        $distance = $this->calculator->calculate('test', 'test');
        $this->assertEquals(0, $distance, 'Distance between identical strings should be 0');
    }

    public function testCalculateSingleInsertion(): void
    {
        $distance = $this->calculator->calculate('test', 'tests');
        $this->assertEquals(1, $distance, 'Distance between "test" and "tests" should be 1');
    }

    public function testCalculateSingleDeletion(): void
    {
        $distance = $this->calculator->calculate('tests', 'test');
        $this->assertEquals(1, $distance, 'Distance between "tests" and "test" should be 1');
    }

    public function testCalculateSingleSubstitution(): void
    {
        $distance = $this->calculator->calculate('test', 'tent');
        $this->assertEquals(1, $distance, 'Distance between "test" and "tent" should be 1');
    }

    public function testCalculateMultipleOperations(): void
    {
        $distance = $this->calculator->calculate('kitten', 'sitting');
        $this->assertEquals(3, $distance, 'Distance between "kitten" and "sitting" should be 3');
    }

    public function testCalculateCompletelyDifferentStrings(): void
    {
        $distance = $this->calculator->calculate('abc', 'xyz');
        $this->assertEquals(3, $distance, 'Distance between "abc" and "xyz" should be 3');
    }
}

