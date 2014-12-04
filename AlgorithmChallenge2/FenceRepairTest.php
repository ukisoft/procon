<?php

namespace ProCon;

require_once('FenceRepair.php');

class FenceRepairTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param $boardsLength
     * @param $expected
     */
    public function testCalc($boardsLength, $expected)
    {
        $actual = FenceRepair::calc($boardsLength);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[8, 5, 8], 34]];
    }
} 