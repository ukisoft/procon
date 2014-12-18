<?php

namespace Vip;

require_once('FizzBuzz.php');

class FizzBuzzTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var FizzBuzz
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new FizzBuzz();
    }

    /**
     * @dataProvider provider
     */
    public function testCountPaths($num, $expected)
    {
        $actual = $this->targetClass->getFizzBuzz($num);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[15, "1\n2\nFizz\n4\nBuzz\nFizz\n7\n8\nFizz\nBuzz\n11\nFizz\n13\n14\nFizzBuzz\n"]];
    }
}