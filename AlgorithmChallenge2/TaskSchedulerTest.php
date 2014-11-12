<?php

namespace ProCon;

require_once('TaskScheduler.php');

class TaskSchedulerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provider
     * @param $startTimes
     * @param $endTimes
     * @param $expected
     */
    public function testFindMaxTaskCount($startTimes, $endTimes, $expected)
    {
        $actual = TaskScheduler::findMaxTaskCount($startTimes, $endTimes);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[1, 2, 4, 6, 8], [3, 5, 7, 9, 10], 3]];
    }
} 