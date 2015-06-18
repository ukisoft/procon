<?php

namespace ProCon;

require_once('ItemSeparator.php');

class ItemSeparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $n
     * @param $m
     * @param $M
     * @param $expected
     */
    public function testFindShortestStep2($n, $m, $M, $expected)
    {
        $actual = ItemSeparator::calc($n, $m, $M);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[4, 3, 10000, 4]];
    }
}