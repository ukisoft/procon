<?php

namespace ProCon;

require_once('NoLimitKnapsack.php');
require_once('NoLimitKnapsackMemoVer.php');

class NoLimitKnapsackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $items
     * @param $knapsack
     * @param $expected
     */
    public function testCalc($items, $knapsack, $expected)
    {
        $actual = NoLimitKnapsack::calc($items, $knapsack);
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
        $actual = NoLimitKnapsackMemoVer::calc($items, $knapsack);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[[3, 4], [4, 5], [2, 3]], 7, 10],
            [[[2, 11], [4, 10], [6, 20]], 7, 33]];
    }
}