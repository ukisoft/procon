<?php

namespace ProCon;

require_once('0015.php');

class StockHistoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var StockHistory
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new StockHistory();
    }

    /**
     * @dataProvider provider
     */
    public function testMaximumEarnings($initialInvestment, $monthlyContribution, $stockPrices, $expected)
    {
        $actual = $this->targetClass->maximumEarnings($initialInvestment, $monthlyContribution, $stockPrices);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[1000, 0, ["10 20 30", "15 24 32"], 500],
            [1000, 0, ["10", "9"], 0],
            [100, 20, ["40 50 60",
                       "37 48 55",
                       "100 48 50",
                       "105 48 47",
                       "110 50 52",
                       "110 50 52",
                       "110 51 54",
                       "109 49 53"], 239]];
    }
}
