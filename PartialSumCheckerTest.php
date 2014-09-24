<?php

namespace ProCon;

require_once('PartialSumChecker.php');

class PartialSumCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testJudge($partialNumSubjects, $sumTarget, $expected)
    {
        $actual = PartialSumChecker::check($partialNumSubjects, $sumTarget);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[1, 2, 4, 7], 13, true],
                [[1, 2, 4, 7], 15, false],
                [[1], 0, true]];
    }
}