<?php

namespace ProCon;

require_once('PartialSumCalculator.php');

class PartialSumCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testGetWalkingTime($partialNumSubjects, $sumTarget, $expected)
    {
        $actual = PartialSumCalculator::judge($partialNumSubjects, $sumTarget);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[1, 2, 4, 7], 13, true],
            [[1, 2, 4, 7], 15, false]];
    }
}