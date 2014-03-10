<?php

require_once 'PHPUnit/Autoload.php';
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
        $actual = 12;

        $testArray = array('1', '2', '3');
        $expected = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }

    public function test_encrypt_set2() {
        $actual = 36;

        $testArray = array('1', '3', '2', '1', '1', '3');
        $expected = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }

    public function test_encrypt_set3() {
        $actual = 986074810223904000;

        $testArray = array('1000', '999', '998', '997', '996', '995');
        $expected = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }

    public function test_encrypt_set4() {
        $actual = 2;

        $testArray = array('1', '1', '1', '1');
        $expected = $this->targetClass->encrypt($testArray);

        $this->assertEquals($expected, $actual);
    }
}
