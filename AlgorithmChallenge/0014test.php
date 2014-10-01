<?php

namespace ProCon;

require_once('0014.php');

class ColorfulBoxesAndBallsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ColorfulBoxesAndBalls
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new ColorfulBoxesAndBalls();
    }

    /**
     * @dataProvider provider
     */
    public function testGetMaximum($numRed, $numBlue, $onlyRed, $onlyBlue, $bothColors, $expected)
    {
        $actual = $this->targetClass->getMaximum($numRed, $numBlue, $onlyRed, $onlyBlue, $bothColors);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[2, 3, 100, 400, 200, 1400],
                [2, 3, 100, 400, 300, 1600],
                [5, 5, 464, 464, 464, 4640],
                [1, 4, 20, -30, -10, -100],
                [9, 1, -1, -10, 4, 0]];
    }
}