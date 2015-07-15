<?php

namespace ProCon;

require_once('OverlapPattern.php');

class OverlapPatternTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $n
     * @param $m
     * @param $a
     * @param $M
     * @param $expected
     */
    public function testCalc2($n, $m, $a, $M, $expected)
    {
        $actual = OverlapPattern::calc($n, $m, $a, $M);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[3, 3, [1, 2, 3], 10000, 6]];
    }
}