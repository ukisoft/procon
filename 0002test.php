<?php

namespace ProCon;

require_once('0002.php');

class InterestingPartyTest extends PHPUnit_Framework_TestCase {

    /**
     * @var InterestingParty
     */
    private $targetClass;

    function setUp() {
        $this->targetClass = new InterestingParty();
    }

    function test_bestInvitation_set1() {
        $expected = 4;

        $testFirst = array('fishing', 'gardening', 'swimming', 'fishing');
        $testSecond = array('hunting', 'fishing', 'fishing', 'biting');
        $actual = $this->targetClass->bestInvitation($testFirst, $testSecond);

        $this->assertEquals($expected, $actual);
    }

    function test_bestInvitation_set2() {
        $expected = 1;

        $testFirst = array('variety', 'diversity', 'loquacity', 'courtesy');
        $testSecond = array('talking', 'speaking', 'discussion', 'meeting');
        $actual = $this->targetClass->bestInvitation($testFirst, $testSecond);

        $this->assertEquals($expected, $actual);
    }

    function test_bestInvitation_set3() {
        $expected = 3;

        $testFirst = array('snakes', 'programming', 'cobra', 'monty');
        $testSecond = array('python', 'python', 'anaconda', 'python');
        $actual = $this->targetClass->bestInvitation($testFirst, $testSecond);

        $this->assertEquals($expected, $actual);
    }

    function test_bestInvitation_set4() {
        $expected = 6;

        $testFirst = array('t', 'o', 'p', 'c', 'o', 'd', 'e', 'r', 's', 'i', 'n', 'g', 'l', 'e', 'r', 'o', 'u', 'n', 'd', 'm', 'a', 't', 'c', 'h', 'f', 'o', 'u', 'r', 'n', 'i');
        $testSecond = array('n', 'e', 'f', 'o', 'u', 'r', 'j', 'a', 'n', 'u', 'a', 'r', 'y', 't', 'w', 'e', 'n', 't', 'y', 't', 'w', 'o', 's', 'a', 't', 'u', 'r', 'd', 'a', 'y');
        $actual = $this->targetClass->bestInvitation($testFirst, $testSecond);

        $this->assertEquals($expected, $actual);
    }
}