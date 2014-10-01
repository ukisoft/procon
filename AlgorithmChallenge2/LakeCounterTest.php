<?php

namespace ProCon;

require_once('LakeCounter.php');

class LakeCounterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param int $rowNum
     * @param int $columnNum
     * @param array $lakes
     * @param int $expected
     */
    public function testCount($lakes, $expected)
    {
        $actual = LakeCounter::get($lakes);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[['W........WW.',
                  '.WWW.....WWW',
                  '....WW...WW.',
                  '.........WW.',
                  '.........W..',
                  '..W......W..',
                  '.W.W.....WW.',
                  'W.W.W.....W.',
                  '.W.W......W.',
                  '..W.......W.'], 3]];
    }
}