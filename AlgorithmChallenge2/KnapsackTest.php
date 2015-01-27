<?php

namespace ProCon;

require_once('Knapsack.php');

class KnapsackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $weights
     * @param $knapsack
     * @param $expected
     */
    public function testCalcWithDp($weights, $knapsack, $expected)
    {
        $actual = Knapsack::calcWithDp($weights, $knapsack);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[[2, 3], [1, 2], [3, 4], [2, 2]], 5, 7]];
    }
}