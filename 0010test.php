<?php

namespace ProCon;

require_once('0010.php');

class CorporationSalaryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var CorporationSalary
     */
    private $targetClass;

    public function setUp()
    {
        $this->targetClass = new CorporationSalary();
    }

    /**
     * @dataProvider provider
     */
    public function testTotalSalary($actualRelations, $expected)
    {
        $actual = $this->targetClass->totalSalary($actualRelations);
        $this->assertEquals($expected, $actual);
    }

    public function provider()
    {
        return [[['N'], 1],
                [["NNYN", "NNYN", "NNNN", "NYYN"], 5],
                [["NNNNNN", "YNYNNY", "YNNNNY", "NNNNNN", "YNYNNN", "YNNYNN"], 17],
                [["NYNNYN", "NNNNNN", "NNNNNN", "NNYNNN", "NNNNNN", "NNNYYN"], 8],
                [["NNNN", "NNNN", "NNNN", "NNNN"], 4]];
    }
}
