<?php

namespace ProCon;

require_once('0018.php');

class CirclesCountryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var CirclesCountry
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new CirclesCountry();
    }

    /**
     * @dataProvider provider
     */
    public function testLeastBorders($x, $y, $r, $x1, $x2, $y1, $y2, $expected)
    {
        $actual = $this->targetClass->leastBorders($x, $y, $r, $x1, $x2, $y1, $y2);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[0], [0], [2], -5, 1, 5, 1, 0],
                [[0, -6, 6], [0, 1, 2], [2, 2, 2], -5, 1, 5, 1, 2],
                [[1, -3, 2, 5, -4, 12, 12], [1, -1, 2, 5, 5, 1, 1], [8, 1, 2, 1, 1, 1, 2], -5, 1, 12, 1, 3],
                [[-3, 2, 2, 0, -4, 12, 12, 12], [-1, 2, 3, 1, 5, 1, 1, 1], [1, 3, 1, 7, 1, 1, 2, 3], 2, 3, 13, 2, 5]];
    }
}
