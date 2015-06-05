<?php

namespace ProCon;

require_once('PartialSumWithLimit.php');

class PartialSumWithLimitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $a
     * @param $m
     * @param $k
     * @param $expected
     */
    public function testCalc($a, $m, $k, $expected)
    {
        $actual = PartialSumWithLimit::calc($a, $m, $k);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[3, 5, 8], [3, 2, 2], 17, true],
            [[3], [3], 12, false],
            [[1], [100000], 100000, true]];
    }
}