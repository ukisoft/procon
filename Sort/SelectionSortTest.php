<?php

namespace ProCon;

require_once('SelectionSort.php');

class SelectionSortTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function test_sortInt($array, $expected)
    {
        $actual = SelectionSort::sortInt($array);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[1, 3, 2, 5], [1, 2, 3, 5]],
            [[3, 3, 5, 1], [1, 3, 3, 5]]];
    }
}
