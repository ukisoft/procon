<?php

namespace ProCon;

require_once('LongestIncreasingSubsequence.php');

class LongestIncreasingSubsequenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $a
     * @param $expected
     */
    public function testCalc($a, $expected)
    {
        $actual = LongestIncreasingSubsequence::solve($a);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[4, 2, 3, 1, 5], 3]];
    }
}