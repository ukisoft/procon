<?php

namespace ProCon;

require_once('LongestCommonSubsequence.php');

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

    public function provider()
    {
        return [['abcd', 'becd', 3],
            ['ABCBDAB', 'BDCABA', 4],
            ['ABCBDAB', 'BDCABAA', 4],
            ['a', 'aba', 1],
            ['aa', 'aa', 2],
            [str_repeat('a', 1000), str_repeat('a', 1000), 1000]];
    }
}