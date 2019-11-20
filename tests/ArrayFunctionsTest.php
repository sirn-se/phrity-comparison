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
 * Test class for array functions tests.
 */
class ArrayFunctionsTest extends TestCase
{

    /**
     * Set up for all tests
     */
    public function setUp(): void
    {
        error_reporting(-1);
    }

    /**
     * Test usort
     */
    public function testSort(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];

        $res = usort($comparables, function ($item_1, $item_2) {
            return $item_1->compare($item_2);
        });

        $this->assertTrue($res);
        $this->assertEquals([$b, $d, $c, $a], $comparables);
    }

    /**
     * Test array_filter
     */
    public function testFilter(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];
        $condition = new ComparableObject(5);

        $filtered = array_values(array_filter($comparables, function ($item) use ($condition) {
            return $item->lessThan($condition);
        }));

        $this->assertEquals([$b, $d], $filtered);
    }

    /**
     * Test array_reduce
     */
    public function testReduce(): void
    {
        $a = new ComparableObject(9);
        $b = new ComparableObject(2);
        $c = new ComparableObject(7);
        $d = new ComparableObject(4);
        $comparables = [$a, $b, $c, $d];
        $condition = new ComparableObject(5);

        $reduced = array_reduce($comparables, function ($item_1, $item_2) {
            if (is_null($item_1)) {
                return $item_2;
            }
            return $item_1->lessThan($item_2) ? $item_1 : $item_2;
        });

        $this->assertEquals($b, $reduced);
    }
}
