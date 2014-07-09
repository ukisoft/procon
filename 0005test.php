<?php

require_once('0005.php');

class ThePalindromeTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ThePalindrome
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new ThePalindrome();
    }

    function test_find_set1() {
        $expected = 5;
        $actual = $this->targetClass->find('abab');
        $this->assertEquals($expected, $actual);
    }

    function test_find_set2() {
        $expected = 7;
        $actual = $this->targetClass->find('abacaba');
        $this->assertEquals($expected, $actual);
    }

    function test_find_set3() {
        $expected = 11;
        $actual = $this->targetClass->find('qwerty');
        $this->assertEquals($expected, $actual);
    }

    function test_find_set4() {
        $expected = 38;
        $actual = $this->targetClass->find('abdfhdyrbdbsdfghjkllkjhgfds');
        $this->assertEquals($expected, $actual);
    }

    function test_find_set5() {
        $expected = 11;
        $actual = $this->targetClass->find('abcbca');
        $this->assertEquals($expected, $actual);
    }
}

