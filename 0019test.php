<?php

namespace ProCon;

require_once('0019.php');

class HamiltonPathTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var HamiltonPath
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new HamiltonPath();
    }

    /**
     * @dataProvider provider
     */
    public function testLeastBorders($roads, $expected)
    {
        $actual = $this->targetClass->countPaths($roads);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[['NYN', 'YNN', 'NNN'], 4],
            [['NYYY', 'YNNN', 'YNNN', 'YNNN'], 0],
            [['NYY', 'YNY', 'YYN'], 0],
            [['NNNNNY', 'NNNNYN', 'NNNNYN', 'NNNNNN', 'NYYNNN', 'YNNNNN'], 24],
            [["NYNY","YNYN","NYNY","YNYN"], 0]];
    }
}
