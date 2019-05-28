<?php
/**
 * File for comparison test class.
 * @package Phrity > Comparison
 */
namespace Phrity\Comparison;

use Mock\ComparableObject;
use PHPUnit_Framework_TestCase;

/**
 * Test class for array functions tests.
 */
class ArrayFunctionsTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test usort
     */
    public function testSort()
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
    public function testFilter()
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
     * Test incomparable exception
     * @expectedException Phrity\Comparison\IncomparableException
     */
    public function testIncomparable()
    {
        $a = new ComparableObject(9);
        $b = new \stdclass;
        $comparables = [$a, $b];

        $res = usort($comparables, function ($item_1, $item_2) {
            return $item_1->compare($item_2);
        });
    }
}
