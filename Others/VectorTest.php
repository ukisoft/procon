<?php

namespace Procon;

require_once('Vector.php');

class VectorTest extends \PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $vector = new Vector('one', 'two', 'three');

        $this->assertEquals('one', $vector->get(0));
        $this->assertEquals('two', $vector->get(1));
        $this->assertEquals('three', $vector->get(2));
    }


    public function testAdd()
    {
        $vector = new Vector('one', 'two', 'three');
        $vector->add('four');

        $this->assertEquals('four', $vector->get(3));
    }

    public function testContainsTrue()
    {
        $vector = new Vector('one', 'two', 'three');
        $this->assertTrue($vector->contains('one'));
    }

    public function testContainsFalse()
    {
        $vector = new Vector('one', 'two', 'three');
        $this->assertFalse($vector->contains('four'));
    }

    public function testSetOk()
    {
        $vector = new Vector('one', 'two', 'three');
        $vector->set(1, 'twooo');

        $this->assertEquals('twooo', $vector->get(1));
    }

    /**
     * @expectedException OutOfRangeException
     */
    public function testSetException()
    {
        $vector = new Vector('one', 'two', 'three');
        $vector->set(3, 'four');
    }

    public function testSize()
    {
        $vector = new Vector('one', 'two', 'three');

        $this->assertEquals(3, $vector->size());
    }

    public function testRemoveOk()
    {
        $vector = new Vector('one', 'two', 'three');
        $vector->remove(1);

        $this->assertEquals('one', $vector->get(0));
        $this->assertEquals('three', $vector->get(1));
    }

    /**
     * @expectedException OutOfRangeException
     */
    public function testRemoveException()
    {
        $vector = new Vector('one', 'two', 'three');
        $vector->remove(3);
    }

    public function testInsertOk()
    {
        $vector = new Vector('one', 'two', 'three');
        $vector->insert(0, 'zero');

        $this->assertEquals('zero', $vector->get(0));
        $this->assertEquals('one', $vector->get(1));
        $this->assertEquals('two', $vector->get(2));
        $this->assertEquals('three', $vector->get(3));
    }

    /**
     * @expectedException OutOfRangeException
     */
    public function testInsertException()
    {
        $vector = new Vector('one', 'two', 'three');
        $vector->insert(3, 'four');
    }
}
