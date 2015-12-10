<?php

namespace ProCon;

require_once('LongestCommonSubsequence.php');
require_once('LongestCommonSubsequence2.php');

class LongestCommonSubsequenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $firstWords
     * @param $secondWords
     * @param $expected
     */
    public function testCalc($firstWords, $secondWords, $expected)
    {
        $actual = LongestCommonSubsequence::calc($firstWords, $secondWords);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider provider
     * @param $firstWords
     * @param $secondWords
     * @param $expected
     */
    public function testCalc2($firstWords, $secondWords, $expected)
    {
        $actual = LongestCommonSubsequence2::calc($firstWords, $secondWords);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [['abcd', 'becd', 3],
            ['ABCBDAB', 'BDCABA', 4],
            ['ABCBDAB', 'BDCABAA', 4],
            ['a', 'aba', 1],
            ['aa', 'aa', 2],
            [str_repeat('a', 1000), str_repeat('a', 1000), 1000],
            ['aaaacaa', 'aacaaac', 5],
            ['baad', 'aabd', 3],
            ["bbacd", "bbxcd", 4]];
    }
}