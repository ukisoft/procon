<?php

namespace Vip;

require_once('vip03_PrimeNumberChecker.php');

class PrimeNumberCheckerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PrimeNumberChecker
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new PrimeNumberChecker();
    }

    /**
     * @dataProvider provider
     */
    public function testCountPaths($target, $expected)
    {
        $actual = $this->targetClass->check($target);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[3, true],
                [11, true],
                [12, false],
                [10000000001, false]];
    }
}
