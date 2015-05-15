<?php

namespace ProCon;

require_once('KnapsackSelect.php');

class KnapsackSelectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $items
     * @param $rate
     * @param $expected
     */
    public function testCalc($items, $rate, $expected)
    {
        $actual = KnapsackSelect::calc($items, $rate);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[5, 10, 5, 20.34], 30, [10, [1]]],
            [[5, 10, 25, 60], 30, [30, [0, 2]]],
            [[5, 10, 20, 65], 30, [30, [1, 2]]]];
    }

}