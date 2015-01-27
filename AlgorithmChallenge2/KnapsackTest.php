<?php

namespace ProCon;

require_once('Knapsack.php');

class KnapsackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $items
     * @param $knapsack
     * @param $expected
     */
    public function testCalcWithDp($items, $knapsack, $expected)
    {
        $actual = Knapsack::calcWithDp($items, $knapsack);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[[2, 3], [1, 2], [3, 4], [2, 2]], 5, 7]];
    }
}