<?php

namespace Phrity\Comparison;

use Mock\ComparableObject;
use PHPUnit_Framework_TestCase;

class ComparisonTest extends PHPUnit_Framework_TestCase
{
    public function testEquals()
    {
        $a = new ComparableObject(1);
        $b = new ComparableObject(1);

        $this->assertEquals(0, $a->compare($b));
        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->lessThan($b));
        $this->assertTrue($a->lessThanOrEqual($b));
        $this->assertFalse($a->greaterThan($b));
        $this->assertTrue($a->greaterThanOrEqual($b));
    }

    public function testLessThan()
    {
        $a = new ComparableObject(2);
        $b = new ComparableObject(1);

        $this->assertEquals(-1, $a->compare($b));
        $this->assertFalse($a->equals($b));
        $this->assertTrue($a->lessThan($b));
        $this->assertTrue($a->lessThanOrEqual($b));
        $this->assertFalse($a->greaterThan($b));
        $this->assertFalse($a->greaterThanOrEqual($b));
    }

    public function testGreaterThan()
    {
        $a = new ComparableObject(1);
        $b = new ComparableObject(2);

        $this->assertEquals(1, $a->compare($b));
        $this->assertFalse($a->equals($b));
        $this->assertFalse($a->lessThan($b));
        $this->assertFalse($a->lessThanOrEqual($b));
        $this->assertTrue($a->greaterThan($b));
        $this->assertTrue($a->greaterThanOrEqual($b));
    }

    /**
     * @expectedException Phrity\Comparison\IncomparableException
     */
    public function testIncomparable()
    {
        $a = new ComparableObject(1);
        $b = new ComparableObject('invalid');

        $this->assertEquals(1, $a->compare($b));
    }
}