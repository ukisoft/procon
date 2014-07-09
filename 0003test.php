<?php

require_once('0003.php');

class CryptographyTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Cryptography
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new Cryptography();
    }

    public function test_encrypt_set1() {
        $expected = 12;

        $testArray = array('1', '2', '3');
        $actual = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }

    public function test_encrypt_set2() {
        $expected = 36;

        $testArray = array('1', '3', '2', '1', '1', '3');
        $actual = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }

    public function test_encrypt_set3() {
        $expected = 986074810223904000;

        $testArray = array('1000', '999', '998', '997', '996', '995');
        $actual = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }

    public function test_encrypt_set4() {
        $expected = 2;

        $testArray = array('1', '1', '1', '1');
        $actual = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }
}
