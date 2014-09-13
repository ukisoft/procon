<?php

namespace Vip;

require_once('vip01_Loop.php');

class LoopTest extends \PHPUnit_Framework_TestCase{

    /**
     * @var Loop
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new Loop();
    }

    /**
     * @dataProvider provider
     */
    public function testCountPaths($num, $expected)
    {
        $actual = $this->targetClass->getLoop($num);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[5, "Hello World!\nHello World!\nHello World!\nHello World!\nHello World!\n"],
                [7, "Hello World!\nHello World!\nHello World!\nHello World!\nHello World!\nHello World!\nHello World!\n"],];
    }
}