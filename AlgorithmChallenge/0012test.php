<?php

namespace ProCon;

require_once('0012.php');

class ChessMetricTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ChessMetric
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new ChessMetric();
    }

    /**
     * @dataProvider provider
     */
    public function testHowMany($actualSize, $actualStart, $actualEnd, $actualNumMoves, $expected)
    {
        $actual = $this->targetClass->howMany($actualSize, $actualStart, $actualEnd, $actualNumMoves);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[3, [0, 0], [1, 0], 1, 1],
                [3, [0, 0], [1, 2], 1, 1],
                [3, [0, 0], [2, 2], 1, 0],
                [3, [0, 0], [0, 0], 2, 5],
                [100, [0, 0], [0, 99], 50, 243097320072600]];
    }
}
