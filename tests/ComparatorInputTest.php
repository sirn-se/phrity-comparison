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
 * Test class for Comparator utility using null or empty array input.
 */
class ComparatorInputTest extends TestCase
{

    /**
     * Set up for all tests
     */
    public function setUp(): void
    {
        error_reporting(-1);
    }

    /**
     * Test sort with null
     */
    public function testSortNull(): void
    {
        $comparator = new Comparator();
        $sorted = $comparator->sort();

        $this->assertEquals([], $sorted);
    }

    /**
     * Test sort with empty array
     */
    public function testSortEmpty(): void
    {
        $comparator = new Comparator();
        $sorted = $comparator->sort([]);

        $this->assertEquals([], $sorted);
    }

    /**
     * Test eqauls with null
     */
    public function testEqualsNull(): void
    {
        $condition = new ComparableObject(2);

        $comparator = new Comparator();
        $filtered = $comparator->equals($condition);

        $this->assertEquals([], $filtered);
    }

    /**
     * Test eqauls with empty array
     */
    public function testEqualsEmpty(): void
    {
        $condition = new ComparableObject(2);

        $comparator = new Comparator();
        $filtered = $comparator->equals($condition, []);

        $this->assertEquals([], $filtered);
    }

    /**
     * Test minimum with null
     */
    public function testMinNull(): void
    {
        $comparator = new Comparator();
        $filtered = $comparator->min();

        $this->assertNull($filtered);
    }

    /**
     * Test minimum with empty array
     */
    public function testMinEmpty(): void
    {
        $comparator = new Comparator();
        $filtered = $comparator->min([]);

        $this->assertNull($filtered);
    }
}
