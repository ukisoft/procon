<?php

require_once('0009.php');

class NumberMagicEasyTest extends PHPUnit_Framework_TestCase {

    /**
     * @var NumberMagicEasy
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new NumberMagicEasy();
    }

    public function test_theNumber_set1() {
        $expected = 5;
        $actual = $this->targetClass->theNumber('YNYY');

        $this->assertEquals($expected, $actual);
    }

    public function test_theNumber_set2() {
        $expected = 8;
        $actual = $this->targetClass->theNumber('YNNN');

        $this->assertEquals($expected, $actual);
    }

    public function test_theNumber_set3() {
        $expected = 16;
        $actual = $this->targetClass->theNumber('NNNN');

        $this->assertEquals($expected, $actual);
    }

    public function test_theNumber_set4() {
        $expected = 1;
        $actual = $this->targetClass->theNumber('YYYY');

        $this->assertEquals($expected, $actual);
    }

    public function test_theNumber_set5() {
        $expected = 11;
        $actual = $this->targetClass->theNumber('NYNY');

        $this->assertEquals($expected, $actual);
    }
}
