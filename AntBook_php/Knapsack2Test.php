<?php

namespace ProCon;

require_once('Knapsack2.php');

class Knapsack2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $items
     * @param $knapsack
     * @param $expected
     */
    public function testCalc($items, $knapsack, $expected)
    {
        $actual = Knapsack2::calc($items, $knapsack);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        $items = [];
        for ($i = 0; $i < 100; $i++) {
            $items[$i] = [10000000 - $i, $i + 1];
        }
        $items2 = [];
        for ($i = 0; $i < 100; $i++) {
            $items2[$i] = [(int)(9876543 / ($i + 1)), $i + 1];
        }
        return [[[[2, 3], [1, 2], [3, 4], [2, 2]], 5, 7],
            [[[2, 11], [4, 10], [6, 20]], 7, 21],
            [[[11, 15], [2, 3], [3, 1], [4, 4], [1, 2], [5, 8]], 15, 20],
            [[[1, 2], [10, 100], [3, 2], [4, 2], [2, 2], [6, 2], [7, 2], [8, 2], [9, 2], [5, 2], [11, 2], [12, 2]], 10, 100],
            [$items, 1000000000, 5050],
            [$items2, 1000000000, 5050]];
    }
}