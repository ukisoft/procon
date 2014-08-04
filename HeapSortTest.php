<?php

namespace ProCon;

require_once('HeapSort.php');

class HeapSortTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function test_sortInt($array, $expected)
    {
        $actual = HeapSort::sortInt($array);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[[1, 3, 2, 5], [1, 2, 3, 5]],
            [[3, 3, 5, 1], [1, 3, 3, 5]]];
    }
}
