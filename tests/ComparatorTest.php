<?php
/**
 * File for comparison test class.
 * @package Phrity > Comparison
 */
namespace Phrity\Comparison;

use Mock\ComparableObject;
use PHPUnit_Framework_TestCase;

/**
 * Test class for Comparator utility.
 */
class ComparatorTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test sort
     */
    public function testSort()
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
    public function testRsort()
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
     * @expectedException Phrity\Comparison\IncomparableException
     */
    public function testIncomparableSort()
    {
        $a = new ComparableObject(9);
        $b = new \stdclass;

        $comparator = new Comparator();
        $sorted = $comparator->sort([$a, $b]);
    }

    /**
     * Test incomparable exception
     * @expectedException Phrity\Comparison\IncomparableException
     */
    public function testIncomparableRsort()
    {
        $a = new ComparableObject(9);
        $b = new \stdclass;

        $comparator = new Comparator();
        $sorted = $comparator->rsort([$a, $b]);
    }

    /**
     * Test eqauls filter
     */
    public function testEquals()
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
    public function testGreaterThanFilter()
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
    public function testGreaterThanOrEqualFilter()
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
    public function testLessThanFilter()
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
    public function testLessThanOrEqualFilter()
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
    public function testMin()
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
    public function testMax()
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
