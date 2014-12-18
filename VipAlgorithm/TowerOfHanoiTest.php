<?php

namespace ProCon;

require_once('TowerOfHanoi.php');

class TowerOfHanoiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $circleNum
     * @param $expected
     */
    public function testCalc($circleNum, $expected)
    {
        $actual = TowerOfHanoi::calc($circleNum);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [
            [1, 1],
            [2, 3],
            [3, 7],
            [4, 15],
            [5, 31],
            [6, 63],
            [7, 127],
            [8, 255],
            [9, 511],
            [10, 1023]];
    }

} 