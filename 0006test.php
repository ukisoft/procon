<?php

require_once('0006.php');

class FriendScoreTest extends PHPUnit_Framework_TestCase {

    /**
     * @var FriendScore
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new FriendScore();
    }

    function test_highestScore_set1() {
        $expected = 0;
        $actual = $this->targetClass->highestScore(["NNN", "NNN", "NNN"]);
        $this->assertEquals($expected, $actual);
    }

    function test_highestScore_set2() {
        $expected = 2;
        $actual = $this->targetClass->highestScore(["NYY", "YNY", "YYN"]);
        $this->assertEquals($expected, $actual);
    }

    function test_highestScore_set3() {
        $expected = 4;
        $actual = $this->targetClass->highestScore(["NYNNN", "YNYNN", "NYNYN", "NNYNY", "NNNYN"]);
        $this->assertEquals($expected, $actual);
    }

    function test_highestScore_set4() {
        $expected = 8;
        $actual = $this->targetClass->highestScore(
            ["NNNNYNNNNN",
            "NNNNYNYYNN",
            "NNNYYYNNNN",
            "NNYNNNNNNN",
            "YYYNNNNNNY",
            "NNYNNNNNYN",
            "NYNNNNNYNN",
            "NYNNNNYNNN",
            "NNNNNYNNNN",
            "NNNNYNNNNN"]);
        $this->assertEquals($expected, $actual);
    }

    function test_highestScore_set5() {
        $expected = 6;
        $actual = $this->targetClass->highestScore(
            ["NNNNNNNNNNNNNNY",
            "NNNNNNNNNNNNNNN",
            "NNNNNNNYNNNNNNN",
            "NNNNNNNYNNNNNNY",
            "NNNNNNNNNNNNNNY",
            "NNNNNNNNYNNNNNN",
            "NNNNNNNNNNNNNNN",
            "NNYYNNNNNNNNNNN",
            "NNNNNYNNNNNYNNN",
            "NNNNNNNNNNNNNNY",
            "NNNNNNNNNNNNNNN",
            "NNNNNNNNYNNNNNN",
            "NNNNNNNNNNNNNNN",
            "NNNNNNNNNNNNNNN",
            "YNNYYNNNNYNNNNN"]);
        $this->assertEquals($expected, $actual);
    }
}