<?php

namespace ProCon;

require_once('ItemSeparator.php');
require_once('ItemSeparatorVer2.php');

class ItemSeparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $n
     * @param $m
     * @param $M
     * @param $expected
     */
    public function testCalc($n, $m, $M, $expected)
    {
        $actual = ItemSeparator::calc($n, $m, $M);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider provider
     * @param $n
     * @param $m
     * @param $M
     * @param $expected
     */
    public function testCalc2($n, $m, $M, $expected)
    {
        $actual = ItemSeparatorVer2::calc($n, $m, $M);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[4, 3, 10000, 4], [5, 5, 10000, 7]];
    }
}