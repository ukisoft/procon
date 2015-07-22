<?php

namespace ProCon;

require_once('LabyrinthGuide.php');
require_once('LabyrinthGuide2.php');

class LabyrinthGuideTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     * @param array $labyrinthMap
     * @param int $expected
     */
    public function testFindShortestStep($labyrinthMap, $expected)
    {
        $actual = LabyrinthGuide::findShortestStep($labyrinthMap);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider provider
     * @param array $labyrinthMap
     * @param int $expected
     */
    public function testFindShortestStep2($labyrinthMap, $expected)
    {
        $actual = LabyrinthGuide2::findShortestStep($labyrinthMap);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[['#S######.#',
                  '......#..#',
                  '.#.##.##.#',
                  '.#........',
                  '##.##.####',
                  '....#....#',
                  '.#######.#',
                  '....#.....',
                  '.####.###.',
                  '....#...G#'], 22]];
    }
} 