<?php

namespace ProCon;

require_once('MinimumCoinCalculator.php');

class MinimumCoinCalculatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provider
     * @param int $coin1
     * @param int $coin5
     * @param int $coin10
     * @param int $coin50
     * @param int $coin100
     * @param int $coin500
     * @param int $payment
     * @param int $expected
     */
    public function testFindShortestStep2($coin1, $coin5, $coin10, $coin50, $coin100, $coin500, $payment, $expected)
    {
        $actual = MinimumCoinCalculator::get($coin1, $coin5, $coin10, $coin50, $coin100, $coin500, $payment);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[3, 2, 1, 3, 0, 2, 620, 6]];
    }

} 