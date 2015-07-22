<?php

namespace ProCon;

require_once('BestCowLiner.php');

class BestCowLinerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $inputString
     * @param $expected
     */
    public function testGet($inputString, $expected)
    {
        $actual = BestCowLiner::get($inputString);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [['ACDBCB', 'ABCBCD']];
    }
} 