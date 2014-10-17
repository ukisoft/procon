<?php

namespace ProCon;

require_once('LabyrinthGuide.php');

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