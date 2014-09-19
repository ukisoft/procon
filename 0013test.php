<?php

namespace ProCon;

require_once('0013.php');

class HandShakingTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var HandShaking
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new HandShaking();
    }

    /**
     * @dataProvider provider
     */
    public function testCountPerfect($n, $expected)
    {
        $actual = $this->targetClass->countPerfect($n);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[2, 1], [4, 2], [8, 14]];
    }
}