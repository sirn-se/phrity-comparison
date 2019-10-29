<?php
declare(strict_types=1);

/**
 * File for comparison test class.
 * @package Phrity > Comparison
 */
namespace Phrity\Comparison;

use Mock\ComparableObject;
use PHPUnit\Framework\TestCase;

/**
 * Test class for comparison tests.
 */
class ComparisonTest extends TestCase
{

    /**
     * Set up for all tests
     */
    public function setUp(): void
    {
        error_reporting(-1);
    }

    /**
     * Test equals
     */
    public function testEquals(): void
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

    /**
     * Test less than
     */
    public function testLessThan(): void
    {
        $a = new ComparableObject(1);
        $b = new ComparableObject(2);

        $this->assertEquals(-1, $a->compare($b));
        $this->assertFalse($a->equals($b));
        $this->assertTrue($a->lessThan($b));
        $this->assertTrue($a->lessThanOrEqual($b));
        $this->assertFalse($a->greaterThan($b));
        $this->assertFalse($a->greaterThanOrEqual($b));
    }

    /**
     * Test greater than
     */
    public function testGreaterThan(): void
    {
        $a = new ComparableObject(2);
        $b = new ComparableObject(1);

        $this->assertEquals(1, $a->compare($b));
        $this->assertFalse($a->equals($b));
        $this->assertFalse($a->lessThan($b));
        $this->assertFalse($a->lessThanOrEqual($b));
        $this->assertTrue($a->greaterThan($b));
        $this->assertTrue($a->greaterThanOrEqual($b));
    }

    /**
     * Test incomparable exception
     */
    public function testIncomparable(): void
    {
        $a = new ComparableObject(1);
        $b = new ComparableObject('invalid');

        $this->expectException('Phrity\Comparison\IncomparableException');
        $this->assertEquals(1, $a->compare($b));
    }
}
