<?php

require_once('0008.php');

class MazeMakerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var MazeMaker
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new MazeMaker();
    }

    public function test_longestPath_set1() {
        $expected = 3;
        $actual = $this->targetClass->longestPath(['...', '...', '...'], 0, 1, [1, 0, -1, 0], [0, 1, 0, -1]);

        $this->assertEquals($expected, $actual);
    }

    public function test_longestPath_set2() {
        $expected = 2;
        $actual = $this->targetClass->longestPath(['...', '...', '...'], 0, 1, [1, 0, -1, 0, 1, 1, -1, -1], [0, 1, 0, -1, 1, -1, 1, -1]);

        $this->assertEquals($expected, $actual);
    }

    public function test_longestPath_set3() {
        $expected = -1;
        $actual = $this->targetClass->longestPath(['X.X', '...', 'XXX', 'X.X'], 0, 1, [1, 0, -1, 0], [0, 1, 0, -1]);

        $this->assertEquals($expected, $actual);
    }

    public function test_longestPath_set4() {
        $expected = 7;
        $actual = $this->targetClass->longestPath(['.......', 'X.X.X..', 'XXX...X', '....X..', 'X....X.', '.......'], 5, 0, [1, 0, -1, 0,-2, 1], [0, -1, 0, 1, 3, 0]);

        $this->assertEquals($expected, $actual);
    }

    public function test_longestPath_set5() {
        $expected = 6;
        $actual = $this->targetClass->longestPath(['.......'], 0, 0, [1, 0, 1, 0, 1, 0], [0, 1, 0, 1, 0, 1]);

        $this->assertEquals($expected, $actual);
    }

    public function test_longestPath_set6() {
        $expected = -1;
        $actual = $this->targetClass->longestPath(['..X.X.X.X.X.X.'], 0, 0, [2, 0, -2, 0], [0, 2, 0, -2]);

        $this->assertEquals($expected, $actual);
    }
}
