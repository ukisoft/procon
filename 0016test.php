<?php

namespace ProCon;

require_once('0016.php');

class BatchSystemTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var BatchSystem
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new BatchSystem();
    }

    /**
     * @dataProvider provider
     */
    public function testSchedule($duration, $user, $expected)
    {
        $actual = $this->targetClass->schedule($duration, $user);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[400, 100, 100, 100], ["Danny Messer", "Stella Bonasera", "Stella Bonasera", "Mac Taylor"], [3, 1, 2, 0]],
            [[200, 200, 200], ["Gil", "Sarah", "Warrick"], [0, 1, 2]],
            [[100, 200, 50], ["Horatio Caine", "horatio caine", "YEAAAAAAH"], [2, 0, 1]]];
    }
}
