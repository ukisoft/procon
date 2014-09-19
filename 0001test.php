<?php

namespace ProCon;

require_once('0001.php');

class KiwiJuiceEasyTest extends PHPUnit_Framework_TestCase {

    /**
     * @var KiwiJuiceEasy
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new KiwiJuiceEasy();
    }

    function test_thePouring_set1() {
        $expected = [0, 13];
        $actual = $this->targetClass->thePouring([20, 20], [5, 8], [0], [1]);
        $this->assertEquals($expected, $actual);
    }

    function test_thePouring_set2() {
        $expected = [3, 10];
        $actual = $this->targetClass->thePouring([10, 10], [5, 8], [0], [1]);
        $this->assertEquals($expected, $actual);
    }

    function test_thePouring_set3() {
        $expected = [10, 10, 0];
        $actual = $this->targetClass->thePouring([30, 20, 10], [10, 5, 5], [0, 1, 2], [1, 2, 0]);
        $this->assertEquals($expected, $actual);
    }

    function test_thePouring_set4() {
        $expected = [0, 14, 65, 35, 25, 35];
        $actual = $this->targetClass->thePouring([14, 35, 86, 58, 25, 62], [6, 34, 27, 38, 9, 60], [1, 2, 4, 5, 3, 3, 1, 0], [0, 1, 2, 4, 2, 5, 3, 1]);
        $this->assertEquals($expected, $actual);
    }

    function test_thePouring_set5() {
        $expected = [0, 156956, 900000, 856956];
        $actual = $this->targetClass->thePouring([700000, 800000, 900000, 1000000], [478478, 478478, 478478, 478478], [2, 3, 2, 0, 1], [0, 1, 1, 3, 2]);
        $this->assertEquals($expected, $actual);
    }
}

