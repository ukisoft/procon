<?php

namespace ProCon;

require_once('0017.php');

class AutoLoanTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AutoLoan
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new AutoLoan();
    }

    /**
     * @dataProvider provider
     */
    public function testInterestRate($price, $monthlyPayment, $loanTerm, $expected)
    {
        $actual = $this->targetClass->interestRate($price, $monthlyPayment, $loanTerm);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[6800, 100, 68, 1.3322616182218813E-13],
            [2000, 510, 4, 9.56205462458368],
            [15000, 364, 48, 7.687856394581649]];
    }
}
