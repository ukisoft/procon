<?php

namespace ProCon;

require_once('LeapYear.php');

class LeapYearTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $year
     * @param $expected
     */
    public function testSolve($year, $expected)
    {
        $actual = LeapYear::solve($year);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[2000, true], [1900, false], [1001, false], [1004, true], [2111, false], [2160, true]];
    }
} 