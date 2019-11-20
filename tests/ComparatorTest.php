<?php

/**
 * File for comparison test class.
 * @package Phrity > Comparison
 */

declare(strict_types=1);

namespace Phrity\Comparison;

use Mock\ComparableObject;
use PHPUnit\Framework\TestCase;

/**
 * Test class for Comparator utility.
 */
class ComparatorTest extends TestCase
{

    /**
     * Set up for all tests
     */
    public function setUp(): void
    {
        error_reporting(-1);
    }

    /**
     * Test sort
     */
    public function testSort(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];

        $comparator = new Comparator();
        $sorted = $comparator->sort($comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals([$b, $d, $c, $a], $sorted);
    }

    /**
     * Test reversed sort
     */
    public function testRsort(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];

        $comparator = new Comparator();
        $sorted = $comparator->rsort($comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals([$a, $c, $d, $b], $sorted);
    }

    /**
     * Test incomparable exception
     */
    public function testIncomparableSort(): void
    {
        $a = new ComparableObject(9);
        $b = new \stdclass();

        $comparator = new Comparator();
        $this->expectException('Phrity\Comparison\IncomparableException');
        $sorted = $comparator->sort([$a, $b]);
    }

    /**
     * Test incomparable exception
     */
    public function testIncomparableRsort(): void
    {
        $a = new ComparableObject(9);
        $b = new \stdclass();

        $comparator = new Comparator();
        $this->expectException('Phrity\Comparison\IncomparableException');
        $sorted = $comparator->rsort([$a, $b]);
    }

    /**
     * Test eqauls filter
     */
    public function testEquals(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(2);
        $comparables = [$a, $b, $c, $d];
        $condition = new ComparableObject(2);

        $comparator = new Comparator();
        $filtered = $comparator->equals($condition, $comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals([$b, $d], $filtered);
    }

    /**
     * Test greater than filter
     */
    public function testGreaterThanFilter(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];
        $condition = new ComparableObject(5);

        $comparator = new Comparator();
        $filtered = $comparator->greaterThan($condition, $comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals([$a, $c], $filtered);
    }

    /**
     * Test greater than or equals filter
     */
    public function testGreaterThanOrEqualFilter(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];
        $condition = new ComparableObject(4);

        $comparator = new Comparator();
        $filtered = $comparator->greaterThanOrEqual($condition, $comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals([$a, $c, $d], $filtered);
    }

    /**
     * Test less than filter
     */
    public function testLessThanFilter(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];
        $condition = new ComparableObject(5);

        $comparator = new Comparator();
        $filtered = $comparator->lessThan($condition, $comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals([$b, $d], $filtered);
    }

    /**
     * Test less than or equals filter
     */
    public function testLessThanOrEqualFilter(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];
        $condition = new ComparableObject(4);

        $comparator = new Comparator();
        $filtered = $comparator->lessThanOrEqual($condition, $comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals([$b, $d], $filtered);
    }

    /**
     * Test minimum
     */
    public function testMin(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];

        $comparator = new Comparator();
        $filtered = $comparator->min($comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals($b, $filtered);
    }

    /**
     * Test maximum
     */
    public function testMax(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];

        $comparator = new Comparator();
        $filtered = $comparator->max($comparables);

        $this->assertEquals([$a, $b, $c, $d], $comparables);
        $this->assertEquals($a, $filtered);
    }
}
