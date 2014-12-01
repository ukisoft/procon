<?php

namespace ProCon;

require_once('SarumansArmy.php');

class SarumansArmyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $radius
     * @param $points
     * @param $expected
     */
    public function testCalc($radius, $points, $expected)
    {
        $actual = SarumansArmy::calc($radius, $points);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[10, [1, 7, 15, 20, 30, 50], 3]];
    }
} 