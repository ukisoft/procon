<?php

namespace ProCon;

require_once('Knapsack.php');
require_once('KnapsackMemoVer.php');

class KnapsackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $items
     * @param $knapsack
     * @param $expected
     */
    public function testCalc($items, $knapsack, $expected)
    {
        $actual = Knapsack::calc($items, $knapsack);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider provider
     * @param $items
     * @param $knapsack
     * @param $expected
     */
    public function testCalcMemoVer($items, $knapsack, $expected)
    {
        $actual = KnapsackMemoVer::calc($items, $knapsack);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        $items = [];
        for ($i = 1; $i <= 100; $i++) {
            $items[$i] = [$i, $i];
        }
        return [[[[2, 3], [1, 2], [3, 4], [2, 2]], 5, 7],
            [[[2, 11], [4, 10], [6, 20]], 7, 21],
            [[[11, 15], [2, 3], [3, 1], [4, 4], [1, 2], [5, 8]], 15, 20],
            [[[1, 2], [10, 100], [3, 2], [4, 2], [2, 2], [6, 2], [7, 2], [8, 2], [9, 2], [5, 2], [11, 2], [12, 2]], 10, 100],
            [$items, 10000, 5050]];
    }
}