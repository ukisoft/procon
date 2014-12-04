<?php

namespace ProCon;

require_once('SarumansArmy.php');

class SarumansArmyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $radius
     * @param $positions
     * @param $expected
     */
    public function testCalc($radius, $positions, $expected)
    {
        $actual = SarumansArmy::calc($radius, $positions);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[10, [1, 7, 15, 20, 30, 50], 3]];
    }
}