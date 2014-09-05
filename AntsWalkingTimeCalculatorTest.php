<?php

namespace ProCon;

require_once('AntsWalkingTimeCalculator.php');

class AntsWalkingTimeCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testGetWalkingTime($barLength, $antsNum, $antsPosition, $expectedMin, $expectedMax)
    {
        $actualMax = AntsWalkingTimeCalculator::getMaxWalkingTime($barLength, $antsNum, $antsPosition);
        $this->assertEquals($expectedMax, $actualMax);

        $actualMin = AntsWalkingTimeCalculator::getMinWalkingTime($barLength, $antsNum, $antsPosition);
        $this->assertEquals($expectedMin, $actualMin);
    }

    public function provider()
    {
        return [[10, 3, [2, 6, 7], 4, 8],
                [214, 7, [11, 12, 7, 13, 176, 23, 191], 38, 207]];
    }
} 