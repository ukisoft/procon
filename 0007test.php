<?php

namespace ProCon;

require_once('0007.php');

class CrazyBotTest extends PHPUnit_Framework_TestCase {

    /**
     * @var CrazyBot
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new CrazyBot();
    }

    public function test_getProbability_set1() {
        $expected = 1.0;
        $actual = $this->targetClass->getProbability(1, 25, 25, 25, 25);

        $this->assertEquals($expected, $actual);
    }

    public function test_getProbability_set2() {
        $expected = 0.75;
        $actual = $this->targetClass->getProbability(2, 25, 25, 25, 25);

        $this->assertEquals($expected, $actual);
    }

    public function test_getProbability_set3() {
        $expected = 1.0;
        $actual = $this->targetClass->getProbability(7, 50, 0, 0, 50);

        $this->assertEquals($expected, $actual);
    }

    public function test_getProbability_set4() {
        $expected = 1.220703125e-4;
        $actual = $this->targetClass->getProbability(14, 50, 50, 0, 0);

        $this->assertEquals($expected, $actual);
    }

    public function test_getProbability_set5() {
        $expected = 0.008845493197441101;
        $actual = $this->targetClass->getProbability(14, 25, 25, 25, 25);

        $this->assertEquals($expected, $actual);
    }
}

