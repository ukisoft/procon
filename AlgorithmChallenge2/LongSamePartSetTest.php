<?php

namespace ProCon;

require_once('LongSamePartSet.php');

class LongSamePartSetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $firstWords
     * @param $secondWords
     * @param $expected
     */
    public function testCalc($firstWords, $secondWords, $expected)
    {
        $actual = LongSamePartSet::calc($firstWords, $secondWords);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [['abcd', 'becd', 3],
            ['ABCBDAB', 'BDCABA', 4],
            ['a', 'aba', 1],
            ['aa', 'aa', 2]];
    }
}