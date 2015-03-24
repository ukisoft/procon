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
        return [[[[2, 3], [1, 2], [3, 4], [2, 2]], 5, 7],
        [[[2, 11], [4, 10], [6, 20]], 7, 21]];
    }
}