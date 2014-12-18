<?php

namespace Vip;

use ProCon\SquareConverterVer2;

require_once('SquareConverterVer2.php');

class SquareConverterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var SquareConverterVer2
     */
    private $targetClass;
    private $epsilon = 0.000011;

    public function setUp()
    {
        $this->targetClass = new SquareConverterVer2();
    }

    /**
     * @dataProvider provider
     * @param $num
     * @param $expected
     */
    public function testCountPaths($num, $expected)
    {
        $actual = $this->targetClass->get($num);
        $this->assertTrue(abs($expected - $actual) <= $this->epsilon);
    }

    public function provider()
    {
        return [[2, 1.41421],
            [3, 1.73205],
            [5, 2.23606],
            [6, 2.44948],
            [7, 2.64575],
            [8, 2.82842],
            [10, 3.16227]];
    }
}