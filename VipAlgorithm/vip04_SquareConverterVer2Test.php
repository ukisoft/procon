<?php

namespace Vip;

require_once('vip04_SquareConverterVer2.php');

class SquareConverterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var SquareConverterVer2
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new SquareConverter();
    }

    /**
     * @dataProvider provider
     */
    public function testCountPaths($num, $expected)
    {
        $actual = $this->targetClass->get($num);
        $this->assertEquals($expected, $actual);
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