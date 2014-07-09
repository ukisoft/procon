<?php

require_once('0004.php');

class InterestingDigitsTest extends PHPUnit_Framework_TestCase {

    /**
     * @var InterestingDigits
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new InterestingDigits();
    }

    function test_digits_set1() {
        $expected = [3, 9];
        $actual = $this->targetClass->digits(10);
        $this->assertEquals($expected, $actual);
    }

    function test_digits_set2() {
        $expected = [2];
        $actual = $this->targetClass->digits(3);
        $this->assertEquals($expected, $actual);
    }

    function test_digits_set3() {
        $expected = [2, 4, 8];
        $actual = $this->targetClass->digits(9);
        $this->assertEquals($expected, $actual);
    }

    function test_digits_set4() {
        $expected = [5, 25];
        $actual = $this->targetClass->digits(26);
        $this->assertEquals($expected, $actual);
    }

    function test_digits_set5() {
        $expected = [29];
        $actual = $this->targetClass->digits(30);
        $this->assertEquals($expected, $actual);
    }
}


