<?php

namespace ProCon;

require_once('FenceRepair.php');

class FenceRepairTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $boards
     * @param $expected
     */
    public function testCalc($boards, $expected)
    {
        $actual = FenceRepair::calc($boards);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[8, 5, 8], 34]];
    }
} 