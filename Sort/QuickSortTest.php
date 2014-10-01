<?php

namespace ProCon;

require_once('QuickSort.php');

class QuickSortTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testSortInt($array, $expected)
    {
        $actual = QuickSort::sortInt($array);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[1, 3, 2, 5], [1, 2, 3, 5]],
            [[3, 3, 5, 1], [1, 3, 3, 5]]];
    }
}
